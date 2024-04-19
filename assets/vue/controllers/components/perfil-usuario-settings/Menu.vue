<template>
  <!-- VISTA ESCRITORIO - TABLET -->

  <div class="container">
    <div class="row">
      <div class="col-3 ps-0 d-md-block d-lg-block d-none">
        <div class="container p-2 bg-white h-100">
          <div class="list-group border border-0" id="list-tab" role="tablist">
            <a
              class="list-group-item list-group-item-action active p-2"
              id="list-home-list"
              data-bs-toggle="list"
              href="#list-home"
              role="tab"
              aria-controls="list-home"
              ><i class="fas fa-user pe-2"></i>Mi Perfil</a
            >
            <a
              class="list-group-item list-group-item-action p-2"
              id="list-profile-list"
              data-bs-toggle="list"
              href="#list-profile"
              role="tab"
              aria-controls="list-profile"
              ><i class="fas fa-shopping-bag pe-2"></i>Compras</a
            >
            <a
              class="list-group-item list-group-item-action p-2"
              id="list-messages-list"
              data-bs-toggle="list"
              href="#list-messages"
              role="tab"
              aria-controls="list-messages"
              ><i class="fas fa-money-bill-wave pe-2"></i>Ventas</a
            >
            <a
              class="list-group-item list-group-item-action p-2"
              id="list-settings-list"
              data-bs-toggle="list"
              href="#list-settings"
              role="tab"
              aria-controls="list-settings"
              ><i class="fas fa-cog"></i> Configuración</a
            >
          </div>
        </div>
      </div>
      <div class="col-12 col-md-9 col-lg-9 d-md-block d-lg-block d-none">
        <div class="container tab-content p-4 bg-white" id="nav-tabContent">
          <!-- INICIO CONTENIDO PRIMERA OPCION -->
          <div
            class="tab-pane fade show active"
            id="list-home"
            role="tabpanel"
            aria-labelledby="list-home-list"
          >
            <div class="d-flex justify-content-start align-items-baseline">
              <span class="fs-6 fw-semibold mb-2">Datos de Cuenta</span>
            </div>

            <table class="table border">
              <tbody>
                <tr>
                  <td class="nombre_datos">
                    <p class="p-0 m-0">Correo</p>
                  </td>
                  <td>
                    <input
                      class="form-control form-control-sm"
                      type="email"
                      placeholder="Ingrese su Correo Electronico"
                      aria-label="Ingrese su Correo Electronico"
                    />
                  </td>
                </tr>
                <tr>
                  <td class="nombre_datos">
                    <p class="p-0 m-0">Contraseña</p>
                  </td>
                  <td>
                    <input
                      class="form-control form-control-sm"
                      type="password"
                      placeholder="Contraseña"
                      aria-label="Contraseña"
                    />
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="d-flex justify-content-start align-items-baseline">
              <span class="fs-6 fw-semibold mb-2 mt-5">Datos personales</span>
            </div>

            <table class="table border">
              <tbody>
                <tr>
                  <td class="nombre_datos">
                    <p class="p-0 m-0">Nombres</p>
                  </td>
                  <td>
                    <input
                      class="form-control form-control-sm"
                      type="text"
                      placeholder="Nombres"
                      aria-label="Nombres"
                    />
                  </td>
                </tr>
                <tr>
                  <td class="nombre_datos">
                    <p class="p-0 m-0">Apellidos</p>
                  </td>
                  <td>
                    <input
                      class="form-control form-control-sm"
                      type="text"
                      placeholder="Apellidos"
                      aria-label="Apellidos"
                    />
                  </td>
                </tr>
                <tr>
                  <td class="nombre_datos">
                    <p class="p-0 m-0">DNI</p>
                  </td>
                  <td>
                    <input
                      class="form-control form-control-sm"
                      type="text"
                      placeholder="DNI"
                      aria-label="DNI"
                    />
                  </td>
                </tr>
                <tr>
                  <td class="nombre_datos">
                    <p class="p-0 m-0">Teléfono</p>
                  </td>
                  <td>
                    <input
                      class="form-control form-control-sm"
                      type="text"
                      placeholder="Teléfono"
                      aria-label="Teléfono"
                    />
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="d-flex justify-content-end align-items-baseline mt-4">
              <button type="button" class="btn btn-secondary btn-sm">
                <i class="fas fa-edit"></i> Modificar datos
              </button>
            </div>
          </div>
          <!-- FIN CONTENIDO PRIMERA OPCION -->

          <!-- INICIO CONTENIDO SEGUNDO OPCION -->
          <div
            class="tab-pane fade"
            id="list-profile"
            role="tabpanel"
            aria-labelledby="list-profile-list"
          >
            <div class="d-flex justify-content-start align-items-baseline">
              <span class="fs-6 fw-semibold mb-2">Historial de Compras</span>
            </div>
            <table class="table mb-0 text-center">
              <thead>
                <tr class="table-secondary">
                  <td>Codigo</td>
                  <td>Fecha de compra</td>
                  <td>Total</td>
                  <td>Estado</td>
                  <td>Ver más</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>CO0012</td>
                  <td>11:44 11/01/2024</td>
                  <td>S/. 14 067.00</td>
                  <td>
                    <span class="badge estado_entregado p-2">Entregado</span>
                  </td>
                  <td>
                    <i
                      class="fas fa-eye detalle_compra_venta"
                      data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal"
                    ></i>
                  </td>
                </tr>
                <tr>
                  <td>CO0451</td>
                  <td>20:24 14/06/2024</td>
                  <td>S/. 175.00</td>
                  <td>
                    <span class="badge estado_encamino p-2">En camino</span>
                  </td>
                  <td>
                    <i
                      class="fas fa-eye detalle_compra_venta"
                      data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal"
                    ></i>
                  </td>
                </tr>
                <tr>
                  <td>CO0012</td>
                  <td>11:44 11/01/2024</td>
                  <td>S/. 14 067.00</td>
                  <td>
                    <span class="badge estado_enproceso p-2">En Proceso</span>
                  </td>
                  <td>
                    <i
                      class="fas fa-eye detalle_compra_venta"
                      data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- FIN CONTENIDO SEGUNDO OPCION -->

          <!-- INICIO CONTENIDO TERCERA OPCION -->
          <div
            class="tab-pane fade"
            id="list-messages"
            role="tabpanel"
            aria-labelledby="list-messages-list"
          >
            <div class="d-flex justify-content-start align-items-baseline">
              <span class="fs-6 fw-semibold mb-2">Historial de Ventas</span>
            </div>
            <table class="table mb-0 text-center">
              <thead>
                <tr class="table-secondary">
                  <td>Codigo</td>
                  <td>Fecha de compra</td>
                  <td>Total</td>
                  <td>Estado</td>
                  <td>Ver más</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>CO0012</td>
                  <td>11:44 11/01/2024</td>
                  <td>S/. 14 067.00</td>
                  <td>
                    <span class="badge estado_entregado p-2">Entregado</span>
                  </td>
                  <td>
                    <i
                      class="fas fa-eye detalle_compra_venta"
                      data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal"
                    ></i>
                  </td>
                </tr>
                <tr>
                  <td>CO0451</td>
                  <td>20:24 14/06/2024</td>
                  <td>S/. 175.00</td>
                  <td>
                    <span class="badge estado_encamino p-2">En camino</span>
                  </td>
                  <td>
                    <i
                      class="fas fa-eye detalle_compra_venta"
                      data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal"
                    ></i>
                  </td>
                </tr>
                <tr>
                  <td>CO0012</td>
                  <td>11:44 11/01/2024</td>
                  <td>S/. 14 067.00</td>
                  <td>
                    <span class="badge estado_enproceso p-2">En Proceso</span>
                  </td>
                  <td>
                    <i
                      class="fas fa-eye detalle_compra_venta"
                      data-bs-target="#exampleModalToggle"
                      data-bs-toggle="modal"
                    ></i>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- FIN CONTENIDO TERCERA OPCION -->

          <div
            class="tab-pane fade"
            id="list-settings"
            role="tabpanel"
            aria-labelledby="list-settings-list"
          >
            <div class="d-flex justify-content-start align-items-baseline">
              <span class="fs-6 fw-semibold mb-2">Configuraciones</span>
            </div>

            <form>
              <table class="table mb-0 border">
                <thead>
                  <tr>
                    <td>
                      <div class="container">
                        <div class="col-12">
                          <div class="row">
                            <div class="col-6 d-flex align-items-center">
                              <p class="fs-6 fw-semibold m-0">
                                Validar información de cuenta
                              </p>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                              <input
                                class="btn btn-outline-dark"
                                type="submit"
                                value="Validar"
                              />
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      El proceso de validación de identidad se lleva a cabo en
                      dos pasos. Primero, se solicita al usuario una foto clara
                      de su documento de identidad (DNI) para verificar la
                      información proporcionada. Luego, se valida la dirección
                      de correo electrónico mediante un enlace enviado al
                      usuario. Este enfoque de doble verificación garantiza la
                      autenticidad del usuario, mejorando la seguridad y
                      protegiendo la integridad del proceso de registro.
                      <div class="row mt-4 justify-content-center">
                        <div
                          class="col-4 form-label"
                          for="validationDefaultUsername"
                        >
                          Validar correo
                        </div>
                        <div class="col-4">
                          <input
                            type="email"
                            class="form-control form-control-sm"
                            id="validationDefaultUsername"
                            aria-describedby="inputGroupPrepend2"
                            placeholder="Verifica Email"
                            aria-label="Verifica Email"
                            required
                          />
                        </div>
                        <div class="col-2">ICON</div>
                      </div>
                      <div class="row mt-2 justify-content-center">
                        <div class="col-4">Validar documento de identidad</div>
                        <div class="col-4">
                          <input
                            class="form-control form-control-sm"
                            type="file"
                            placeholder="Adjuntar archivo"
                            aria-label="Adjuntar archivo"
                            accept=".png, .jpg, .jpeg"
                            required
                          />
                        </div>
                        <div class="col-2">ICON</div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </form>
            <div class="container border mt-3">
              <div class="row">
                <div class="col-6 p-3">
                  <p class="m-0 fs-6 fw-semibold">
                    ¿Deseas eliminar tu cuenta?
                  </p>
                </div>
                <div class="col-6 d-flex justify-content-end p-2">
                  <button type="button" class="btn btn-danger">
                    Eliminar cuenta
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- POPUP LG MD -->

  <div
    class="modal fade"
    id="exampleModalToggle"
    aria-hidden="true"
    aria-labelledby="exampleModalToggleLabel"
    tabindex="-1"
  >
    <div
      class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"
    >
      <div class="modal-content">
        <div class="modal-header border border-bottom-0">
          <h1
            class="modal-title size-22 fw-semibold"
            id="exampleModalToggleLabel"
          >
            Compra #Codigo Producto
          </h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <p class="fw-semibold mb-3">Datos Generales</p>

          <table class="table mb-0 text-center border">
            <thead>
              <tr class="fw-semibold">
                <td>Codigo</td>
                <td>Fecha de compra</td>
                <td>Total</td>
                <td>Metodo de Pago</td>
                <td>Estado</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>######</td>
                <td>##:## ##/##/####</td>
                <td>S/. # ###.##</td>
                <td>#######</td>
                <td>
                  <span class="badge estado_entregado p-2">#########</span>
                </td>
              </tr>
            </tbody>
          </table>

          <p class="fw-semibold mt-5 mb-3">Detalle</p>

          <div class="container mb-5">
            <div class="row">
              <div class="col-8 p-0">
                <table class="table border mb-0 h-100">
                  <tbody>
                    <tr>
                      <th scope="row">Codigo</th>
                      <td>PR00510</td>
                    </tr>
                    <tr>
                      <th scope="row">Nombre</th>
                      <td>
                        Shark Matrix Self-Empty Robot Vacuum & Mop with No Spots
                        Missed, Bagless 30-Day Capacity.
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Categoria</th>
                      <td>Electrodoméstricos</td>
                    </tr>
                    <tr>
                      <th scope="row">Cantidad</th>
                      <td>1 unidades</td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td>S/. 13 555.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-4 p-0">
                <table class="table table-borderless border mb-0 h-100">
                  <tbody>
                    <tr>
                      <td class="fw-semibold">Imagen</td>
                    </tr>
                    <tr>
                      <td rowspan="4" class="d-flex justify-content-center">
                        <img
                          src="../../img/aspiradora.png"
                          class="img"
                          alt=""
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="container mb-5">
            <div class="row">
              <div class="col-8 p-0">
                <table class="table border mb-0 h-100">
                  <tbody>
                    <tr>
                      <th scope="row">Codigo</th>
                      <td>PR00510</td>
                    </tr>
                    <tr>
                      <th scope="row">Nombre</th>
                      <td>
                        Shark Matrix Self-Empty Robot Vacuum & Mop with No Spots
                        Missed, Bagless 30-Day Capacity.
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Categoria</th>
                      <td>Electrodoméstricos</td>
                    </tr>
                    <tr>
                      <th scope="row">Cantidad</th>
                      <td>1 unidades</td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td>S/. 13 555.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-4 p-0">
                <table class="table table-borderless border mb-0 h-100">
                  <tbody>
                    <tr>
                      <td class="fw-semibold">Imagen</td>
                    </tr>
                    <tr>
                      <td rowspan="4" class="d-flex justify-content-center">
                        <img
                          src="../../img/usuario-ejemplo.png"
                          class="img"
                          alt=""
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="container mb-5">
            <div class="row">
              <div class="col-8 p-0">
                <table class="table border mb-0 h-100">
                  <tbody>
                    <tr>
                      <th scope="row">Codigo</th>
                      <td>PR00510</td>
                    </tr>
                    <tr>
                      <th scope="row">Nombre</th>
                      <td>
                        Shark Matrix Self-Empty Robot Vacuum & Mop with No Spots
                        Missed, Bagless 30-Day Capacity.
                      </td>
                    </tr>
                    <tr>
                      <th scope="row">Categoria</th>
                      <td>Electrodoméstricos</td>
                    </tr>
                    <tr>
                      <th scope="row">Cantidad</th>
                      <td>1 unidades</td>
                    </tr>
                    <tr>
                      <th scope="row">Total</th>
                      <td>S/. 13 555.00</td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-4 p-0">
                <table class="table table-borderless border mb-0 h-100">
                  <tbody>
                    <tr>
                      <td class="fw-semibold">Imagen</td>
                    </tr>
                    <tr>
                      <td rowspan="4" class="d-flex justify-content-center">
                        <img
                          src="../../img/producto-prueba.png"
                          class="img"
                          alt=""
                        />
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- VISTA MOVIL -->

  <div class="container d-md-none d-lg-none d-block">
    <div class="row">
      <div class="col-12 ps-0 pe-0">
        <div
          class="container col-11 p-2 bg-white mb-4 rounded container-shadow"
        >
          <div class="container p-2">
            <div class="row align-items-center">
              <div class="col-3 m-0 d-flex justify-content-center">
                <div class="d-flex justify-content-center align-items-center">
                  <img
                    class="img-fluid rounded-pill"
                    src="../../img/usuario-ejemplo.png"
                    alt=""
                  />
                </div>
              </div>
              <div class="col-9 m-0 d-flex align-items-center">
                <div class="container">
                  <div class="row">
                    <div class="col-12 m-0 p-0">
                      <p class="m-0 size-18">Josue Chambilla</p>
                    </div>
                    <div class="col-12 m-0 p-0">
                      <p class="m-0 fw-light text-truncate">
                        josuechambilla565@gmail.com
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="container p-2 bg-white">
          <a
            class="btn custom-btn btn-lg d-block mb-2 text-start"
            href="http://127.0.0.1:8000/mi-perfil-movil"
          >
            <div class="container">
              <div class="row">
                <div class="col-2 m-0 d-flex justify-content-center">
                  <i
                    class="fas fa-user pe-2 fa-2x d-flex justify-content-center align-items-center"
                  ></i>
                </div>
                <div class="col-10 m-0 d-flex">
                  <div class="row align-items-center">
                    <div class="col-12 m-0">
                      <p class="m-0 size-16">Mi Perfil</p>
                    </div>
                    <div class="col-12 m-0">
                      <p class="m-0 size-14 fw-light">
                        Gestiona tus datos personales.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <a
            class="btn custom-btn btn-lg d-block mb-2 text-start"
           href="http://127.0.0.1:8000/compras-movil"
          >
            <div class="container">
              <div class="row">
                <div class="col-2 m-0 d-flex justify-content-center">
                  <i
                    class="fas fa-shopping-bag pe-2 fa-2x d-flex justify-content-center align-items-center"
                  ></i>
                </div>
                <div class="col-10 m-0 d-flex">
                  <div class="row align-items-center">
                    <div class="col-12 m-0">
                      <p class="m-0 size-16">Compras</p>
                    </div>
                    <div class="col-12 m-0">
                      <p class="m-0 size-14 fw-light">
                        Historial de compras realizadas.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <a
            class="btn custom-btn btn-lg d-block mb-2 text-start"
             href="http://127.0.0.1:8000/ventas-movil"
          >
            <div class="container">
              <div class="row">
                <div class="col-2 m-0 d-flex justify-content-center">
                  <i
                    class="fas fa-money-bill-wave pe-2 fa-2x d-flex justify-content-center align-items-center"
                  ></i>
                </div>
                <div class="col-10 m-0 d-flex">
                  <div class="row align-items-center">
                    <div class="col-12 m-0">
                      <p class="m-0 size-16">Ventas</p>
                    </div>
                    <div class="col-12 m-0">
                      <p class="m-0 size-14 fw-light">
                        Historial de ventas realizadas.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>

          <a
            class="btn custom-btn btn-lg d-block mb-2 text-start"
             href="http://127.0.0.1:8000/configuracion-movil"
          >
            <div class="container">
              <div class="row">
                <div class="col-2 m-0 d-flex justify-content-center">
                  <i
                    class="fas fa-cog pe-2 fa-2x d-flex justify-content-center align-items-center"
                  ></i>
                </div>
                <div class="col-10 m-0 d-flex">
                  <div class="row align-items-center">
                    <div class="col-12 m-0">
                      <p class="m-0 size-16">Configuración</p>
                    </div>
                    <div class="col-12 m-0">
                      <p class="m-0 size-14 fw-light">
                        Valida o Elimina tu cuenta.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {};
</script>

<style scoped>
.detalle_compra_venta {
  cursor: pointer;
}

.list-group-item.active {
  background-color: #17172b !important;
  border-color: #17172b !important;
}
.img {
  max-width: 50%;
  /* max-height: 200px; */
  aspect-ratio: 1/1;
}

.nombre_datos {
  width: 20%;
  vertical-align: middle;
}
.list-group {
  --bs-list-group-border-width: none;
}
.form-control {
  color: #807d7d;
}

i.active {
  color: #ffffff;
}

/* Estilos segunda opcion */
.estado_entregado {
  background-color: #06a629;
}
.estado_encamino {
  background-color: #0000ff;
}
.estado_enproceso {
  background-color: #ff0000;
}

/* Estilos tercera opcion */
.estado_entregado {
  background-color: #06a629;
}
.estado_encamino {
  background-color: #0000ff;
}
.estado_enproceso {
  background-color: #ff0000;
}

/* ESTILOS PARA MOVIL */

.container-shadow {
  box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.3);
}

.custom-btn {
  background-color: transparent;
  color: #000;
  border-color: transparent;
}

.custom-btn:hover {
  background-color: #17172b !important;
  border-color: #17172b !important;
  color: #fff;
}

.custom-btn:active,
.custom-btn.active {
  background-color: #17172b !important;
  border-color: #17172b !important;
  color: #fff;
}


</style>
