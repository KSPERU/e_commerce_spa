<?php

namespace App\Funciones\tiendaks\compras;

use Fpdf\Fpdf;
use App\Entity\Compras\compras;
use App\Entity\Factura\factura;
use App\Entity\Compras\detallecompra;
use App\Entity\Factura\detallefactura;
use App\Entity\Usuario\usuario;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\Compras\comprasRepository;
use App\Repository\Factura\facturaRepository;
use App\Repository\Usuario\usuarioRepository;
use App\Repository\Compras\detallecompraRepository;
use App\Funciones\tiendaks\usuario\UsuarioFunciones;
use App\Repository\Factura\detallefacturaRepository;
use App\Funciones\tiendaks\producto\ProductoFunciones;
use DateTime;

class ComprasFunciones
{
    private $usuarioRepository;
    private $comprasRepository;
    private $facturaRepository;
    private $detallecompraRepository;
    private $detallefacturaRepository;
    private $productoFunciones;
    private $entityManager;
    private $usuario;

    public function __construct(UsuarioFunciones $usuarioFunciones,EntityManagerInterface $entityManager)
    {
        $this->usuario = $usuarioFunciones->obtenerUsuario();
        $this->entityManager = $entityManager;
    }

    public function setUsuarioRepository(usuarioRepository $usuarioRepository){
        $this->usuarioRepository = $usuarioRepository;
    }

    public function setComprasRepository(comprasRepository $comprasRepository){
        $this->comprasRepository = $comprasRepository;
    }

    public function setFacturaRepository(facturaRepository $facturaRepository){
        $this->facturaRepository = $facturaRepository;
    }

    public function setDetalleCompraRepository(detallecompraRepository $detallecompraRepository){
        $this->detallecompraRepository = $detallecompraRepository;
    }

    public function setDetalleFacturaRepository(detallefacturaRepository $detallefacturaRepository){
        $this->detallefacturaRepository = $detallefacturaRepository;
    }

    public function setProductoFunciones(ProductoFunciones $productoFunciones){
        $this->productoFunciones = $productoFunciones;
    }

    public function obtenerComprasTodos(array $criterios = []){   
        $compras = [];
        if (isset($criterios['ParamsCompraList']['usuario_id'])) {
            $compras = $this->obtenerComprasListadoRegistradasPorIdUsuario($criterios['ParamsCompraList']['usuario_id']);
        }
        return $this->convertirComprasAArrayLista($compras);
    }

    private function obtenerComprasListadoRegistradasPorIdUsuario(int $usuario_id){
        $usuario = $this->usuarioRepository->findOneBy([
            'id' => $usuario_id,
        ]);
        $compras = $this->comprasRepository->findBy([
            'cliente' => $usuario,
        ]);
        return $compras;
    }

    private function convertirComprasAArrayLista(array $compras){
        $comprasListado = [];
        foreach ($compras as $compras_u) {
            $comprasListado[] = $this->convertirComprasAArray($compras_u);
        }
        return $comprasListado;
    }

    private function convertirComprasAArray(compras $compras){
        $detallecompra = $compras->getDetallecompras();
        $detallecompraArr = [];
        foreach ($detallecompra as $articulo) {
            $articuloArr = [
                'id' => $articulo->getId(),
                'dcm_cantidad' => $articulo->getDcmCantidad(),
                'dcm_importe' => $articulo->getDcmImporte(),
                'dcm_estado' => $articulo->getDcmEstado(),
                'producto' => $this->productoFunciones->convertirProductoAArray($articulo->getProducto())
            ];
            array_push($detallecompraArr, $articuloArr);
        }
        return [
            'id' => $compras->getId(),
            'cm_cantidadtotal' => $compras->getCmCantidadtotal(),
            'cm_importetotal' => $compras->getCmImportetotal(),
            'cm_fechacompra' => $compras->getCmFechacompra(),
            'detallecompras' => $detallecompraArr,
        ];
    }
    public function comprarCarrito()
    {
        $usuario = $this->usuario;

        if ($usuario === null || $usuario->getCarrito() === null) {
            return [
                'success' => false,
                'message' => 'No hay carrito para realizar la compra.',
            ];
        }

        $carrito = $usuario->getCarrito();
        $detallesCarrito = $carrito->getDetallescarrito();

        if ($detallesCarrito->isEmpty()) {
            return [
                'success' => false,
                'message' => 'El carrito esta vacío, no hay productos para comprar.',
            ];
        }

        $compra = new compras();
        $compra->setCliente($usuario);
        $compra->setCmCantidadtotal($carrito->getCCantidadtotal());
        $compra->setCmImportetotal($carrito->getCImportetotal());
        $compra->setCmFechacompra(new \DateTime('now'));

        $this->entityManager->persist($compra);
        $this->entityManager->flush();

        foreach ($detallesCarrito as $detalleCarrito) {
            $detalleCompra = new detallecompra();
            $detalleCompra->setCompra($compra);
            $detalleCompra->setProducto($detalleCarrito->getProducto());
            $detalleCompra->setDcmCantidad($detalleCarrito->getDcCantidad());
            $detalleCompra->setDcmImporte($detalleCarrito->getDcImporte());
            $detalleCompra->setDcmEstado(0);
            $producto = $detalleCompra->getProducto();
            $producto->setPrStock($producto->getPrStock()-$detalleCarrito->getDcCantidad());

            $this->entityManager->persist($detalleCompra);
            $this->entityManager->remove($detalleCarrito);
        }

        $this->entityManager->remove($carrito);
        $this->entityManager->flush();

        return [
            'success' => true,
            'message' => 'Compra realizada con exito.',
        ];
    }

    private function crearnuevafactura(compras $compra)
    {
        $factura = new factura;
        $factura->setCompra($compra);
        $factura->setCliente($compra->getCliente());
        $factura->setFNumfactura($compra->getId());
        $factura->setFCantidadtotal($compra->getCmCantidadtotal());
        $factura->setFImportetotal($compra->getCmImportetotal());
        $factura->setFDescuentototal($compra->getCmDescuentototal());
        $factura->setFImportetotalfinal($compra->getCmImportetotalfinal());
        $factura->setFFechacreacion(new DateTime());
        $this->entityManager->persist($factura);
        $detallesCompra = $compra->getDetallecompras();
        foreach ($detallesCompra as $detalleCompra) {
            $detalleFactura = new detallefactura();
            $detalleFactura->setFactura($factura);
            $detalleFactura->setProducto($detalleCompra->getProducto());
            $detalleFactura->setDfCantidad($detalleCompra->getDcmCantidad());
            $detalleFactura->setDfImporte($detalleCompra->getDcmImporte());
            $detalleFactura->setDfDescuento($detalleCompra->getDcmDescuento());
            $detalleFactura->setDfImportefinal($detalleCompra->getDcmImportefinal());
            $this->entityManager->persist($detalleFactura);
        }
        $this->entityManager->flush();
        return $factura;
    }
    
    public function crearFactura(int $idCompra): string
    {
        $usuario = $this->usuario;
        $compra = $this->comprasRepository->findOneBy([
            'id' => $idCompra,
        ]);
        $factura = $compra->getFactura();
        if (!$factura) {
            $factura = $this->crearnuevafactura($compra);
        }
        $contenidoPdf = $this->generarContenidoPdf($usuario, $factura);
        return $contenidoPdf;
    }

    private function generarContenidoPdf(usuario $usuario, factura $factura): string
    {
        $pdf = new FPDF($orientation='P',$unit='mm');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',20);    
        $textypos = 5;
        $pdf->setY(12);
        $pdf->setX(10);
        // Agregamos los datos del cliente
        $pdf->Cell(5,$textypos,"TIENDA KS");
        $pdf->SetFont('Arial','B',10);    
        $pdf->setY(30);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"CLIENTE:");
        $pdf->SetFont('Arial','',10);    
        $pdf->setY(35);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"Nombre:");
        $pdf->setY(40);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"DNI:");
        $pdf->setY(45);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"Telefono:");
        $pdf->setY(50);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"Email:");
        // Espaciado para los datos del cliente
        $pdf->SetFont('Arial','',10);    
        $pdf->setY(35);$pdf->setX(28);
        $pdf->Cell(5,$textypos,$usuario->getUNombres());
        $pdf->setY(40);$pdf->setX(28);
        $pdf->Cell(5,$textypos,$usuario->getUDni());
        $pdf->setY(45);$pdf->setX(28);
        $pdf->Cell(5,$textypos,$usuario->getUTelefono());
        $pdf->setY(50);$pdf->setX(28);
        $pdf->Cell(5,$textypos,$usuario->getUCorreo());

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial','B',10);    
        $pdf->setY(30);$pdf->setX(110);
        $pdf->Cell(5,$textypos,"FACTURA #");
        $pdf->setY(30);$pdf->setX(131);
        $pdf->Cell(5,$textypos,$factura->getFNumfactura());
        $pdf->SetFont('Arial','',10);    
        $pdf->setY(35);$pdf->setX(110);
        $pdf->Cell(5,$textypos, "FECHA DE FACTURACION:");
        $pdf->setY(40);$pdf->setX(110);
        $pdf->Cell(5,$textypos,$factura->getFFechacreacion()->format('Y-m-d'), 0, 1);

       /// Apartir de aqui empezamos con la tabla de productos
        $pdf->setY(60);$pdf->setX(135);
        $pdf->Ln();
        /////////////////////////////
        //// Array de Cabecera
        $header = array("Producto", "Cantidad", "Importe", "Descuento", "Importe Final");

        //// Array de Productos
        $detalleFacturas = $factura->getDetallefacturas();

        // Column widths
        $w = array(95, 20, 25, 25, 25);

        // Header
        for ($i = 0; $i < count($header); $i++) {
            $pdf->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }
        $pdf->Ln();

        // Data
        $total = 0;
        foreach ($detalleFacturas as $detalleFactura) {
            $pdf->Cell($w[0], 6, $detalleFactura->getProducto()->getPrNombre(), 1);
            $pdf->Cell($w[1], 6, number_format($detalleFactura->getDfCantidad()), 1, 0, 'R');
            $pdf->Cell($w[2], 6, "$ " . number_format($detalleFactura->getDfImporte(), 2, ".", ","), 1, 0, 'R');
            $pdf->Cell($w[3], 6, "$ " . number_format($detalleFactura->getDfDescuento(), 2, ".", ","), 1, 0, 'R');
            $pdf->Cell($w[4], 6, "$ " . number_format($detalleFactura->getDfImportefinal(), 2, ".", ","), 1, 0, 'R');
            $pdf->Ln();
            $total += $detalleFactura->getDfImportefinal(); // Actualizar el total
        }
        /////////////////////////////
        //// Apartir de aqui esta la tabla con los subtotales y totales
        $yposdinamic = 60 + (count($detalleFacturas)*10);

        $pdf->setY($yposdinamic);
        $pdf->setX(235);
            $pdf->Ln();
        /////////////////////////////
        $header = array("", "");
        $data2 = array(
            array("Subtotal",$factura->getFImportetotal()),
            array("Descuento", $factura->getFDescuentototal()),
            array("Total", $factura->getFImportetotalfinal()),
        );
            // Column widths
            $w2 = array(40, 40);
            // Header

            $pdf->Ln();
            // Data
            foreach($data2 as $row)
            {
        $pdf->setX(115);
                $pdf->Cell($w2[0],6,$row[0],1);
                $pdf->Cell($w2[1],6,"$ ".number_format($row[1], 2, ".",","),'1',0,'R');

                $pdf->Ln();
            }
        /////////////////////////////

        $yposdinamic += (count($data2)*10);
        $pdf->SetFont('Arial','B',10);    

        $pdf->setY($yposdinamic);
        $pdf->setX(10);
        $pdf->Cell(5,$textypos,"TERMINOS Y CONDICIONES");
        $pdf->SetFont('Arial','',10);    

        $pdf->setY($yposdinamic+10);
        $pdf->setX(10);
        $pdf->Cell(5,$textypos,"El cliente se compromete a pagar la factura.");
        $pdf->setY($yposdinamic+20);
        $pdf->setX(10);
        $pdfContent = $pdf->Output('S');
        return $pdfContent;
    }
}