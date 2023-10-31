<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import Modal from "@/Components/Modal.vue";
import { ref } from "vue";

// Se obtienen las imágenes del objeto de propiedades usando la función defineProps
const { images } = defineProps(["images"]);

const modal = ref(false); //Variable para controlar el modal
const modalDelete = ref(false);//Variable para controlar el modal "Delete"

// Abre o cierra el modal
const modalChange = () => {
  modal.value = !modal.value;
};

// Abre o cierra el modal "Delete"
const modalDeleteChange = () => {
  modalDelete.value = !modalDelete.value;
};

// variable que contiene el meme seleccionado
let selectedImage = ref();

// Abre el modal con el meme seleccionada
const openImage = (image) => {
  selectedImage.value = image;
  modal.value = !modal.value;
};

// Descarga el meme
const downloadMeme = () => {
  let dataURL = selectedImage.value.image;
  let link = document.createElement("a");
  link.href = dataURL;
  link.download = "meme.png";
  link.click();
};

//Borra el meme seleccionado
function deleteMeme(id){

router.delete(route('meme.destroy',id));
modal.value = !modal.value;
modalDelete.value = !modalDelete.value;
  
}

</script>

<template>
  <Head title="MemeGenerator" />
  <div class="min-h-screen bg-celeste">
    <header class="bg-lila">
      <div class="shrink-0 flex justify-center">
        <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
          <span class="uppercase text-5xl font-ibm font-bold text-white"
            >meme generator</span
          >
        </div>
      </div>
    </header>

    <div class="pb-10">
      <div class="max-w-screen-lg items-center mx-auto sm:px-6">
        <div class="mt-6 flex justify-between items-center">
          <div>
            <span class="font-ibm uppercase font-bold text-4xl">galeria</span>
          </div>
          <div class="-mt-1 mb-2">
            <Link
              as="button"
              :href="route('meme.create')"
              class="bg-[#00F1FF] hover:bg-[#34b1b8] px-3 py-1 rounded-[4px] border-2 border-black"
            >
              <span class="font-ibm uppercase font-bold text-2xl"
                >+ crear meme</span
              >
            </Link>
          </div>
        </div>
        <div
          class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex justify-center items-center"
        >
          <div>
            <div class="px-10 pb-10 pt-10 overflow-y-auto">
              <div class="grid grid-cols-3 gap-4">
                <div
                  v-for="item in images"
                  :key="item.id"
                  class="relative group"
                  @click="openImage(item)"
                >
                  <img
                    :src="item.image"
                    alt="Imagen"
                    class="w-full cursor-pointer h-64 object-cover rounded-lg shadow-md transition-transform transform scale-100 group-hover:scale-105"
                  />
                  <!--Modal que abre cuando se hace click en el meme-->
                  <Modal :show="modal" @close="modalChange">
                    <div>
                      <img
                        :src="selectedImage.image"
                        alt="Imagen"
                        class="w-full h-full"
                      />
                      <div class="absolute top-0 right-0 p-2 opacity-70">
                        <button
                          class="bg-black/50 hover:bg-red-500/50 rounded-full border-2 border-black px-2 py-2"
                          @click="modalChange"
                        >
                          <span class="text-ibm font-bold uppercase text-white"
                            >Cerrar X</span
                          >
                        </button>
                      </div>
                      <div class="absolute top-0 left-0 p-2 opacity-90">
                        <button
                          class="bg-red-500/50 hover:bg-red-500 rounded-full border-2 border-black px-2 py-2"
                          @click="modalDeleteChange"
                        >
                          <span class="text-ibm font-bold uppercase text-white"
                            >&#x1F5D1</span
                          >
                        </button>
                      </div>
                      <div class="absolute top-0 left-11 p-2 opacity-70">
                        <button
                          class="bg-blue-500/50 hover:bg-blue-500 rounded-full border-2 border-black px-2 py-2"
                          @click="downloadMeme"
                        >
                          <span class="text-ibm font-bold uppercase text-white"
                            >&#x1f4e5</span
                          >
                        </button>
                      </div>
                    </div>
                  </Modal>
                  <!--Modal con mensaje de confirmación para borrar el meme-->
                  <Modal :show="modalDelete" maxWidth="sm" @close="modalDeleteChange">
                        <div class="flex flex-col p-4">
                          <div>
                            <span class="font-ibm font-bold uppercase">¿Seguro que quieres borrar este meme?</span>
                          </div>
                          <br>
                          <div class="flex flex-row justify-end space-x-2">
                            <div>
                              <button
                                  @click="deleteMeme(selectedImage.id)"
                                  as="button"
                                  class="inline-flex rounded-md border border-gray-500 bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:ring-offset-2"
                                >
                                  Borrar
                              </button>
                            </div>
                            
                            <div>
                              <button
                                type="button"
                                class="inline-flex rounded-md border border-gray-500 bg-blue-100 px-4 py-2 text-sm font-medium text-blue-900 hover:bg-blue-200 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
                                @click="modalDeleteChange"
                              >
                                Cancelar
                              </button>
                            </div>
                          </div>
                        </div>
                      </Modal>
                </div>
              </div>
              <div v-if="images.length <= 0">
                <div class="">
                  <span
                    class="font-ibm font-bold text-xl text-slate-500 uppercase"
                    >no hay memes aún 😔,<span class="text-black"
                      >crea uno!</span
                    >
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
