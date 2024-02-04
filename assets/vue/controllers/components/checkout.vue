<template>
    <section class="mt-5">
      <div class="container">
        <div style="font-size: 28px; font-weight: 800;">
          CHECKOUT
        </div>
        <div class="row">
          <!-- CARRITO -->  
          <div class="col-md-8">
            <h4 class="card-title mb-4" style="font-size: 16px; font-weight: 600; padding-top:10px">ELIGA METODO DE PAGO</h4>
            <div class="card border shadow-0">
              <div class="m-4">
              <!--Accordion with icons -->
                <div class="accordion accordion-flush" id="accordionFlushExample" style="color:#17172B">
                  <!-- Pago con Tarjeta -->
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne" style="background-color: transparent !important; border: none !important; box-shadow: none !important; color:#17172B">
                        <font-awesome-icon icon="credit-card" style="font-size: 200%;"/>
                        <div style="display: flex; flex-direction: column; padding-left: 10px;">
                          <div style="font-size: 16px;">
                            PAGO CON TARJETA
                          </div>
                          <span class="d-none d-md-block" style="font-size: 12px;">Realiza el pago de forma segura con tu tarjeta de crédito.</span>
                        </div>
                      </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                      <div class="accordion-body">  
                        <form style="font-size: 16px">
                          <!-- Fila 1: Nombre y Apellido -->
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="firstName" class="form-label">Nombre</label>
                                  <input type="text" class="form-control" id="firstName" placeholder="Nombre" required>
                              </div>
                              <div class="col-md-6">
                                  <label for="lastName" class="form-label">Apellido</label>
                                  <input type="text" class="form-control" id="lastName" placeholder="Apellido" required>
                              </div>
                          </div>
                          <!-- Fila 2: DNI, Departamento y Código Postal -->
                          <div class="row mb-3">
                              <div class="col-md-4">
                                  <label for="dni" class="form-label">DNI</label>
                                  <input type="text" class="form-control" id="dni" placeholder="Número de DNI" required>
                              </div>
                              <div class="col-md-4">
                                  <label for="department" class="form-label">Departamento</label>
                                  <input type="text" class="form-control" id="department" placeholder="Departamento" required>
                              </div>
                              <div class="col-md-4">
                                  <label for="postalCode" class="form-label">Código Postal</label>
                                  <input type="text" class="form-control" id="postalCode" placeholder="Código Postal" required>
                              </div>
                          </div>
                          <!-- Fila 3: Dirección -->
                          <div class="mb-3">
                              <label for="address" class="form-label">Dirección de Entrega</label>
                              <input type="text" class="form-control" id="address" placeholder="Dirección" required>
                          </div>
                          <!-- Fila 4: Referencia -->
                          <div class="mb-3">
                              <label for="reference" class="form-label">Referencia de Dirección</label>
                              <input type="text" class="form-control" id="reference" placeholder="Referencia de Dirección">
                          </div>
                          <!-- Fila 5: Datos de la tarjeta -->
                          <div class="row mb-3">
                              <div class="col-md-6">
                                  <label for="cardNumber" class="form-label">N° de Tarjeta</label>
                                  <input type="text" class="form-control" id="cardNumber" placeholder="XXXX-XXXX-XXXX-XXXX">
                              </div>
                              <div class="col-md-3">
                                  <label for="expiryDate" class="form-label">Fecha de Venc.</label>
                                  <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY">
                              </div>
                              <div class="col-md-3">
                                  <label for="cvv" class="form-label">CVV</label>
                                  <input type="text" class="form-control" id="cvv" placeholder="XXX">
                              </div>
                          </div>
                          <button type="submit" class="btn w-100" style="background-color: #17172B; color: #F5F5F5;">Pagar con Tarjeta</button>
                        </form>
                      </div>
                    </div>
                  </div>

                  <!-- Pago en Efectivo -->
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" style="background-color: transparent !important; border: none !important; box-shadow: none !important; color:#17172B">
                          <font-awesome-icon icon="money-bill" style="font-size: 200%"/>
                          <div style="display: flex; flex-direction: column; padding-left: 10px;">
                              <div style="font-size: 16px;">
                                  PAGO EN EFECTIVO
                              </div>
                              <span class="d-none d-md-block" style="font-size: 12px;">Realiza el pago al recibir el producto.</span>
                          </div>
                      </button>
                    </h2>
                      <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                              <form>
                                <!-- Fila 1: Nombre y Apellido -->  
                                <div class="row mb-3">
                                  <div class="col-md-6">
                                    <label for="firstName" class="form-label">Nombre</label>
                                    <input type="text" class="form-control" id="firstName" placeholder="Nombre" required>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lastName" class="form-label">Apellido</label>
                                    <input type="text" class="form-control" id="lastName" placeholder="Apellido" required>
                                  </div>
                                </div>
                                <!-- Fila 2: DNI, Departamento y Código Postal -->
                                <div class="row mb-3">
                                  <div class="col-md-4">
                                    <label for="dni" class="form-label">DNI</label>
                                    <input type="text" class="form-control" id="dni" placeholder="Número de DNI" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="department" class="form-label">Departamento</label>
                                    <input type="text" class="form-control" id="department" placeholder="Departamento" required>
                                  </div>
                                  <div class="col-md-4">
                                    <label for="postalCode" class="form-label">Código Postal</label>
                                    <input type="text" class="form-control" id="postalCode" placeholder="Código Postal" required>
                                  </div>
                                </div>
                                <!-- Fila 3: Dirección -->
                                <div class="mb-3">
                                  <label for="address" class="form-label">Dirección de Entrega</label>
                                  <input type="text" class="form-control" id="address" placeholder="Dirección" required>
                                </div>
                                <!-- Fila 4: Referencia -->
                                <div class="mb-3">
                                  <label for="reference" class="form-label">Referencia de Dirección</label>
                                  <input type="text" class="form-control" id="reference" placeholder="Referencia de Dirección">
                                </div>
                                  <button type="submit" class="btn w-100" style="background-color: #17172B; color: #F5F5F5;">Confirmar Pago en Efectivo</button>
                              </form>
                        </div>
                      </div>
                  </div>
              
                  <!-- Transferencia Bancaria -->
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree" style="background-color: transparent !important; border: none !important; box-shadow: none !important; color:#17172B">
                          <font-awesome-icon icon="city" style="font-size: 200%;"/>
                          <div style="display: flex; flex-direction: column; padding-left: 6px;">
                              <div style="font-size: 16px;">
                                PAGO POR TRANSFERENCIA
                              </div>
                              <span class="d-none d-md-block" style="font-size: 12px;">Paga de manera sencilla y segura mediante transferencia bancaria.</span>
                          </div>
                      </button>
                    </h2>
                      <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                          <form>
                            <!-- Fila 1: Nombre y Apellido -->  
                            <div class="row mb-3">
                              <div class="col-md-6">
                                <label for="firstName" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="firstName" placeholder="Nombre" required>
                              </div>
                              <div class="col-md-6">
                                <label for="lastName" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="lastName" placeholder="Apellido" required>
                              </div>
                            </div>
                            <!-- Fila 2: DNI, Departamento y Código Postal -->
                            <div class="row mb-3">
                              <div class="col-md-4">
                                <label for="dni" class="form-label">DNI</label>
                                <input type="text" class="form-control" id="dni" placeholder="Número de DNI" required>
                              </div>
                              <div class="col-md-4">
                                <label for="department" class="form-label">Departamento</label>
                                <input type="text" class="form-control" id="department" placeholder="Departamento" required>
                              </div>
                              <div class="col-md-4">
                                <label for="postalCode" class="form-label">Código Postal</label>
                                <input type="text" class="form-control" id="postalCode" placeholder="Código Postal" required>
                              </div>
                            </div>
                            <!-- Fila 3: Dirección -->
                            <div class="mb-3">
                              <label for="address" class="form-label">Dirección de Entrega</label>
                              <input type="text" class="form-control" id="address" placeholder="Dirección" required>
                            </div>
                            <!-- Fila 4: Referencia -->
                            <div class="mb-3">
                              <label for="reference" class="form-label">Referencia de Dirección</label>
                              <input type="text" class="form-control" id="reference" placeholder="Referencia de Dirección">
                            </div>
                            <!-- Fila 5: Carga de Imagen -->
                            <div class="mb-3">
                              <label for="paymentImage" class="form-label">Subir Imagen del Comprobante de Pago</label>
                              <input type="file" class="form-control" id="paymentImage" accept="image/*">
                            </div>
                            <button type="submit" class="btn w-100" style="background-color: #17172B; color: #F5F5F5;">Confirmar Pago en Efectivo</button>
                          </form>
                        </div>
                      </div>
                  </div>
              
                  <!-- Yape/Plin -->
                  <div class="accordion-item">
                    <h2 class="accordion-header">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour" style="background-color: transparent !important; border: none !important; box-shadow: none !important; color:#17172B">
                          <font-awesome-icon icon="mobile" style="font-size: 200%; padding-left: 0.5%"/>
                          <div style="display: flex; flex-direction: column; padding-left: 19px;">
                              <div style="font-size: 16px;">
                                YAPE/PLIN
                              </div>
                              <span class="d-none d-md-block" style="font-size: 12px;">Paga fácil, rapido y seguro con Yape o Plin.</span>
                          </div>
                      </button>
                    </h2>
                      <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                          <div class="accordion-body">
                            <form>
                              <!-- Fila 1: Nombre y Apellido -->  
                              <div class="row mb-3">
                                <div class="col-md-6">
                                  <label for="firstName" class="form-label">Nombre</label>
                                  <input type="text" class="form-control" id="firstName" placeholder="Nombre" required>
                                </div>
                                <div class="col-md-6">
                                  <label for="lastName" class="form-label">Apellido</label>
                                  <input type="text" class="form-control" id="lastName" placeholder="Apellido" required>
                                </div>
                              </div>
                              <!-- Fila 2: DNI, Departamento y Código Postal -->
                              <div class="row mb-3">
                                <div class="col-md-4">
                                  <label for="dni" class="form-label">DNI</label>
                                  <input type="text" class="form-control" id="dni" placeholder="Número de DNI" required>
                                </div>
                                <div class="col-md-4">
                                  <label for="department" class="form-label">Departamento</label>
                                  <input type="text" class="form-control" id="department" placeholder="Departamento" required>
                                </div>
                                <div class="col-md-4">
                                  <label for="postalCode" class="form-label">Código Postal</label>
                                  <input type="text" class="form-control" id="postalCode" placeholder="Código Postal" required>
                                </div>
                              </div>
                              <!-- Fila 3: Dirección -->
                              <div class="mb-3">
                                <label for="address" class="form-label">Dirección de Entrega</label>
                                <input type="text" class="form-control" id="address" placeholder="Dirección" required>
                              </div>
                              <!-- Fila 4: Referencia -->
                              <div class="mb-3">
                                <label for="reference" class="form-label">Referencia de Dirección</label>
                                <input type="text" class="form-control" id="reference" placeholder="Referencia de Dirección">
                              </div>
                              <!-- Fila 5: Carga de Imagen -->
                              <div class="mb-3">
                                <label for="paymentImage" class="form-label">Subir Imagen de Pago por Yape/Plin</label>
                                <input type="file" class="form-control" id="paymentImage2" accept="image/*">
                              </div>
                              <button type="submit" class="btn w-100" style="background-color: #17172B; color: #F5F5F5;">Confirmar Pago por Yape/Plin</button>
                            </form>
                          </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- FIN CARRITO -->

          <!-- PRECIO -->
          <div class="col-md-4" style="font-size: 16px;">
            <h4 class="card-title mb-4" style="font-weight: 600;  padding-top:10px">RESUMEN</h4>
            <div class="card shadow-0 border">
              <div class="card-body">
                <div class="d-flex justify-content-between">
                  <p class="mb-2">Subtotal:</p>
                  <p class="mb-2">S/. 14 065.00</p>
                </div>
                <div class="d-flex justify-content-between">
                  <p class="mb-2">Envio:</p>
                  <p class="mb-2">S/. 0</p>
                </div>
                <hr />
                <div class="d-flex justify-content-between">
                  <p class="mb-2">Total:</p>
                  <p class="mb-2 fw-bold">S/. 14 065.00</p>
                </div>
              </div>
            </div>

            <div class="mt-3">
              <a href="#" class="btn w-100 shadow-0 mb-2" style="background-color: #17172B; color: white;">Realizar compra</a>
            </div>

          </div>
          <!-- FIN PRECIO  -->
        </div>
      </div>
    </section>
</template>
<script>
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

    export default{ components: { FontAwesomeIcon } };
</script>