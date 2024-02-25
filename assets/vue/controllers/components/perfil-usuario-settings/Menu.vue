<template>
  <div class="container">
    <div class="row">
      <div class="col-3 ps-0">
        <div class="container p-2 bg-white h-100">
          <div class="list-group border border-0" id="list-tab" role="tablist">
            <a
              class="list-group-item list-group-item-action active"
              id="list-home-list"
              data-bs-toggle="list"
              href="#list-home"
              role="tab"
              aria-controls="list-home"
              ><i class="fas fa-user pe-2"></i>Mi Perfil</a
            >
            <a
              class="list-group-item list-group-item-action"
              id="list-profile-list"
              data-bs-toggle="list"
              href="#list-profile"
              role="tab"
              aria-controls="list-profile"
              ><i class="fas fa-shopping-bag pe-2"></i>Compras</a
            >
            <a
              class="list-group-item list-group-item-action"
              id="list-messages-list"
              data-bs-toggle="list"
              href="#list-messages"
              role="tab"
              aria-controls="list-messages"
              ><i class="fas fa-money-bill-wave pe-2"></i>Ventas</a
            >
            <a
              class="list-group-item list-group-item-action"
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
      <div class="col-9">
        <div
          class="container tab-content p-4 bg-white"
          id="nav-tabContent"
        >
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
                      placeholder=".form-control-sm"
                      aria-label=".form-control-sm example"
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
                      placeholder=".form-control-sm"
                      aria-label=".form-control-sm example"
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
                      placeholder=".form-control-sm"
                      aria-label=".form-control-sm example"
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
                      placeholder=".form-control-sm"
                      aria-label=".form-control-sm example"
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
                      placeholder=".form-control-sm"
                      aria-label=".form-control-sm example"
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
                      placeholder=".form-control-sm"
                      aria-label=".form-control-sm example"
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
                  <td><i class="fas fa-eye"></i></td>
                </tr>
                <tr>
                  <td>CO0451</td>
                  <td>20:24 14/06/2024</td>
                  <td>S/. 175.00</td>
                  <td>
                    <span class="badge estado_encamino p-2">En camino</span>
                  </td>
                  <td><i class="fas fa-eye"></i></td>
                </tr>
                <tr>
                  <td>CO0012</td>
                  <td>11:44 11/01/2024</td>
                  <td>S/. 14 067.00</td>
                  <td>
                    <span class="badge estado_enproceso p-2">En Proceso</span>
                  </td>
                  <td><i class="fas fa-eye"></i></td>
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
                  <td><i class="fas fa-eye"></i></td>
                </tr>
                <tr>
                  <td>CO0451</td>
                  <td>20:24 14/06/2024</td>
                  <td>S/. 175.00</td>
                  <td>
                    <span class="badge estado_encamino p-2">En camino</span>
                  </td>
                  <td><i class="fas fa-eye"></i></td>
                </tr>
                <tr>
                  <td>CO0012</td>
                  <td>11:44 11/01/2024</td>
                  <td>S/. 14 067.00</td>
                  <td>
                    <span class="badge estado_enproceso p-2">En Proceso</span>
                  </td>
                  <td><i class="fas fa-eye"></i></td>
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
            <table class="table mb-0 border">
              <thead>
                <tr>
                  <td class="fs-6 fw-semibold">
                    Validar información de cuenta
                  </td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    El proceso de validación de identidad se lleva a cabo en dos
                    pasos. Primero, se solicita al usuario una foto clara de su
                    documento de identidad (DNI) para verificar la información
                    proporcionada. Luego, se valida la dirección de correo
                    electrónico mediante un enlace enviado al usuario. Este
                    enfoque de doble verificación garantiza la autenticidad del
                    usuario, mejorando la seguridad y protegiendo la integridad
                    del proceso de registro.
                    <div class="row mt-4 justify-content-center">
                      <div class="col-4">Validar correo</div>
                      <div class="col-4">
                        <input
                          class="form-control form-control-sm"
                          type="email"
                          placeholder="Verifica Email"
                          aria-label="Verifica Email"
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
                        />
                      </div>
                      <div class="col-2">ICON</div>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="container border mt-3">
              <div class="row">
                <div class="col-6 p-3">
                  <p class=" m-0 fs-6 fw-semibold">
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
</template>

<script>
export default {};
</script>

<style scoped>
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
</style>
