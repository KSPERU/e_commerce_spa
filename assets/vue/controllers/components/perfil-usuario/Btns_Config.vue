<template>
    <div>
        <div>
            <button class="btn-agregar-producto w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between" type="button" data-bs-toggle="modal" data-bs-target="#add-product">
                Agregar un producto
                <font-awesome-icon icon="angle-right"/>
            </button>
        </div>
        <div>
            <button class="btn-actualizar-productos w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between">
            Actualizar mis productos
            <font-awesome-icon icon="angle-right"/>
            </button>
        </div>
    </div>
    <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="p-0">
            <div class="bg-azul-oscuro h-82px d-flex justify-content-center align-items-center">
                <h5 class="m-0 text-white">¡Hola!, ¿qué producto deseas vender?</h5>
            </div>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" type="text" placeholder="" style="height: 295px;"></textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label class="form-label">Categoría</label>
                        <select class="form-select" >
                            <option value="" selected>Laptops</option>
                            <option value="">Hogar y muebles</option>
                            <option value="">Deporte</option>
                            <option value="">Electrodomésticos</option>
                            <option value="">Cuidado personal</option>
                            <option value="">Juegos</option>
                            <option value="">Salud</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">Precio unitario</label>
                        <input class="form-control" type="number" placeholder="">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">Precio oferta <span class="text-secondary">(Opcional)</span></label>
                        <input class="form-control" type="number" placeholder="">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">Stock</label>
                        <input class="form-control" type="number" placeholder="">
                    </div>
                    <div class="form-group mt-3">
                        <label class="form-label">Tiempo de entrega (dias)</label>
                        <input class="form-control" type="text" placeholder="">
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <label for="" class="form-label">Imagen</label>
                        <div class="col px-2">
                        <div class="square-img overflow-hidden">
                            <div v-if="imagePreview1" id="image-preview-container1">
                            <img :src="imagePreview1" alt="Vista Previa de la Imagen 1" class="image-preview object-fit-cover" style="max-width: 100%;">
                            </div>
                            <span v-else>No hay imagen seleccionada</span>
                            <label v-else for="image-upload-1" class="file-input-label-lg">
                                <input type="file" class="form-control file-input" id="image-upload-1" accept="image/*" @change="handleImageUpload">
                            </label>
                        </div>
                    </div>
                    <div class="col px-1">
                        <div class="square-img-sm mb-2 overflow-hidden">
                            <div v-if="imagePreview2" id="image-preview-container2">
                            <img :src="imagePreview2" alt="Vista Previa de la Imagen 2" class="image-preview object-fit-cover" style="max-width: 100%;">
                            </div>
                            <span v-else>No hay imagen seleccionada</span>
                            <label v-else for="image-upload-2" class="file-input-label">
                                <input type="file" class="form-control file-input" id="image-upload-2" accept="image/*" @change="handleImageUpload">
                            </label>
                        </div>
                        <div class="square-img-sm overflow-hidden">
                            <div v-if="imagePreview3" id="image-preview-container3">
                            <img :src="imagePreview3" alt="Vista Previa de la Imagen 3" class="image-preview object-fit-cover" style="max-width: 100%;">
                            </div>
                            <span v-else>No hay imagen seleccionada</span>
                            <label v-else for="image-upload-3" class="file-input-label">
                                <input type="file" class="form-control file-input" id="image-upload-3" accept="image/*" @change="handleImageUpload">
                            </label>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>

    
</template>


<script>
export default {
  data() {
    return {
      imagePreview1: null,
      imagePreview2: null,
      imagePreview3: null
    };
  },
  methods: {
    handleImageUpload(event) {
      const file = event.target.files[0];
      const reader = new FileReader();

      reader.onload = () => {
        // Determinar cuál input de imagen se está utilizando y establecer la vista previa correspondiente
        switch (event.target.id) {
          case 'image-upload-1':
            this.imagePreview1 = reader.result;
            break;
          case 'image-upload-2':
            this.imagePreview2 = reader.result;
            break;
          case 'image-upload-3':
            this.imagePreview3 = reader.result;
            break;
          default:
            break;
        }
      };

      // Leer el archivo seleccionado
      if (file) {
        reader.readAsDataURL(file);
      } else {
        // Si no se selecciona ninguna imagen, establecer la vista previa correspondiente como nula
        switch (event.target.id) {
          case 'image-upload-1':
            this.imagePreview1 = null;
            break;
          case 'image-upload-2':
            this.imagePreview2 = null;
            break;
          case 'image-upload-3':
            this.imagePreview3 = null;
            break;
          default:
            break;
        }
      }
    }
  }
};
</script>



<style scoped>
.file-input-label-lg{
    width: 220px;
    height: 230px;
    display: inline-block;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  background-color: #ebebeb;
  border-radius: 8px;

}

.file-input-label {
  width: 110px; /* Ancho del cuadrado */
  height: 110px; /* Altura del cuadrado */
  display: inline-block;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  background-color: #ebebeb;
  border-radius: 8px;
}

.file-input {
  position: absolute;
  width: 100%;
  height: 100%;
  opacity: 0;
  cursor: pointer;
}
.square-img{
    width: 220px;
    height: 220px;
    color: #c6c6c6;
}

.square-img-sm{
    width: 110px;
    height: 110px;
    color: #c6c6c6;
}

.fs-72{
    font-size: 72px;
}

.fs-32{
    font-size: 32px;
}

.image-preview {
  width: 100%;
  height: 100%;
  border: 2px solid#ebebeb;
  border-radius: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-bottom: 20px;
  cursor: pointer;
}

.image-preview img {
  max-width: 100%;
  max-height: 100%;
  display: none;
  object-fit: contain;
}

    .btn-agregar-producto, .btn-actualizar-productos{
        background-color: var(--color-azul-oscuro);
        color: #fff;
    }
    .btn-agregar-producto:hover, .btn-actualizar-productos:hover{
        background-color: #3483FA;
        color: #fff;
    }
</style>