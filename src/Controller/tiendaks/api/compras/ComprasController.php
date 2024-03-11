<?php

namespace App\Controller\tiendaks\api\compras;

use Fpdf\Fpdf;
use App\Repository\Compras\comprasRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Funciones\tiendaks\compras\ComprasFunciones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api/compras', name: 'app_api_compras_')]
class ComprasController extends AbstractController
{
    #[Route('/mostrar/compras/listadodeapis', name: 'mostar_compras_listadodeapis')]
    public function mostrarProductoListadoDeApis(): Response
    {
        return $this->render('backend/tiendaks/compras/index.html.twig');
    }

    #[Route('/listar/compras/concriterios', name: 'listar_compras_concriterios', methods: ['POST'])]
    public function listarProductoConCriterios(Request $request, ComprasFunciones $comprasFunciones): JsonResponse
    {
        $datos = json_decode($request->getContent(),true);
        $compras = ($datos !== null) ? $comprasFunciones->obtenerComprasTodos($datos) : $comprasFunciones->obtenerComprasTodos();
        return $this->json($compras, Response::HTTP_OK,[]);
    }

    #[Route('/comprar/carrito', name: 'comprar_carrito')]
    public function comprarCarrito(Request $request, ComprasFunciones $comprasFunciones): Response
    {
        $session = $request->getSession();
        if ($request->isMethod('POST')) {
            $respuesta = $comprasFunciones->comprarCarrito();
            if ($respuesta['success']) {
                $session->remove('comprar');
                $url = $this->generateUrl('app_api_compras_mostar_compras_listadodeapis');
                return new JsonResponse(['url' => $url]);
            } else {
                return new JsonResponse(['message' => $respuesta['message']]);
            }
        }
    }

    #[Route('/mostrar/compras/factura', name: 'mostar_compras_factura', methods: ['POST'])]
    public function mostrarFactura(Request $request, comprasRepository $comprasRepository)
    {
        // $data = json_decode($request->getContent(),true);
        // $idcompra = $data['id_compra'];
        // $pdfContent = $comprasFunciones->crearFactura($idcompra);
        // $response = new Response($pdfContent);
        // $response->headers->set('Content-Type', 'application/pdf');
        // return $response;


        // header('Content-Type: application/pdf');
        // $pdf = new FPDF();
        // $pdf->AddPage();
        // $pdf->SetFont('Arial','B',16);
        // $pdf->Cell(40,10,'¡Hola, Mundo!');
        // $pdfContent = $pdf->Output('S');
        // echo $pdfContent;
        // return $this->render('backend/tiendaks/compras/index.html.twig');


        $data = json_decode($request->getContent(), true);
        $idCompra = $data['id_compra'];
        $compra = $comprasRepository->findOneBy([
            'id' => $idCompra,
        ]);
        if (!$compra) {
            return new Response("Compra no encontrada", Response::HTTP_NOT_FOUND);
        }


        // $pdf = new Fpdf();
        // $pdf->AddPage();
        // $pdf->SetFont('Arial', 'B', 16);
        // $pdf->Cell(0, 10, 'Número de compra: ' . $compra->getId(), 0, 1);
        // $pdf->Cell(0, 10, 'Fecha de compra: ' . $compra->getCmFechacompra()->format('Y-m-d'), 0, 1);
        // $pdf->Cell(0, 10, 'Importe Total: ' . $compra->getCmImportetotal(), 0, 1);
        // $pdf->Cell(0, 10, 'Importe Total Final: ' . $compra->getCmImportetotalfinal(), 0, 1);
        // $pdfContent = $pdf->Output('S');
        // $response = new Response($pdfContent);

        $pdf = new FPDF($orientation='P',$unit='mm');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',20);    
        $textypos = 5;
        $pdf->setY(12);
        $pdf->setX(10);
        // Agregamos los datos de la empresa
        $pdf->Cell(5,$textypos,"NOMBRE DE LA EMPRESA");
        $pdf->SetFont('Arial','B',10);    
        $pdf->setY(30);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"DE:");
        $pdf->SetFont('Arial','',10);    
        $pdf->setY(35);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"Tienda Ks");
        $pdf->setY(40);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"Av Alcanfores");
        $pdf->setY(45);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"12345678");
        $pdf->setY(50);$pdf->setX(10);
        $pdf->Cell(5,$textypos,"ks@gmail.com");

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial','B',10);    
        $pdf->setY(30);$pdf->setX(75);
        $pdf->Cell(5,$textypos,"PARA:");
        $pdf->SetFont('Arial','',10);    
        $pdf->setY(35);$pdf->setX(75);
        $pdf->Cell(5,$textypos,"Nombre del cliente");
        $pdf->setY(40);$pdf->setX(75);
        $pdf->Cell(5,$textypos,"Direccion del cliente");
        $pdf->setY(45);$pdf->setX(75);
        $pdf->Cell(5,$textypos,"Telefono del cliente");
        $pdf->setY(50);$pdf->setX(75);
        $pdf->Cell(5,$textypos,"Email del cliente");

        // Agregamos los datos del cliente
        $pdf->SetFont('Arial','B',10);    
        $pdf->setY(30);$pdf->setX(135);
        $pdf->Cell(5,$textypos,"FACTURA #", $compra->getId());
        $pdf->SetFont('Arial','',10);    
        $pdf->setY(35);$pdf->setX(135);
        $pdf->Cell(5,$textypos, $compra->getCmFechacompra()->format('Y-m-d'), 0, 1);
        $pdf->setY(40);$pdf->setX(135);
        $pdf->Cell(5,$textypos,"Vencimiento: 11/MAR/2024");
        $pdf->setY(45);$pdf->setX(135);
        $pdf->Cell(5,$textypos,"");
        $pdf->setY(50);$pdf->setX(135);
        $pdf->Cell(5,$textypos,"");

        /// Apartir de aqui empezamos con la tabla de productos
        $pdf->setY(60);$pdf->setX(135);
            $pdf->Ln();
        /////////////////////////////
        //// Array de Cabecera
        $header = array("Cod.", "Descripcion","Cant.","Precio","Total");
        //// Arrar de Productos
        $products = array(
            array("0010", "Producto 1",2,120,0),
            array("0024", "Producto 2",5,80,0),
            array("0001", "Producto 3",1,40,0),
            array("0001", "Producto 3",5,80,0),
            array("0001", "Producto 3",4,30,0),
            array("0001", "Producto 3",7,80,0),
        );
            // Column widths
            $w = array(20, 95, 20, 25, 25);
            // Header
            for($i=0;$i<count($header);$i++)
                $pdf->Cell($w[$i],7,$header[$i],1,0,'C');
            $pdf->Ln();
            // Data
            $total = 0;
            foreach($products as $row)
            {
                $pdf->Cell($w[0],6,$row[0],1);
                $pdf->Cell($w[1],6,$row[1],1);
                $pdf->Cell($w[2],6,number_format($row[2]),'1',0,'R');
                $pdf->Cell($w[3],6,"$ ".number_format($row[3],2,".",","),'1',0,'R');
                $pdf->Cell($w[4],6,"$ ".number_format($row[3]*$row[2],2,".",","),'1',0,'R');

                $pdf->Ln();
                $total+=$row[3]*$row[2];

            }
        /////////////////////////////
        //// Apartir de aqui esta la tabla con los subtotales y totales
        $yposdinamic = 60 + (count($products)*10);

        $pdf->setY($yposdinamic);
        $pdf->setX(235);
            $pdf->Ln();
        /////////////////////////////
        $header = array("", "");
        $data2 = array(
            array("Subtotal",$compra->getCmImportetotal()),
            array("Descuento", 0),
            array("Impuesto", 0),
            array("Total", $compra->getCmImportetotalfinal()),
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


        $response = new Response($pdfContent);
        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'inline; filename="factura.pdf"');
        return $response;
    }
}