<script setup>
import { Head, Link } from "@inertiajs/vue3";

const { images } = defineProps(["images"]);
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
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div>
            <div class="px-10 pb-10 pt-10 overflow-y-auto">
              <div class="grid grid-cols-3 gap-4">
                <div
                  v-for="item in images"
                  :key="item.id"
                  class="relative group"
                >
                  <img
                    :src="item.image"
                    alt="Imagen"
                    class="w-full h-64 object-cover rounded-lg shadow-md transition-transform transform scale-100 group-hover:scale-105"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
