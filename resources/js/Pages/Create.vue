<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { fabric } from "fabric";
import { onMounted, ref, computed } from "vue";
import { markRaw } from "vue";

//Variables reactivas
const canvasRef = ref(null);
const canvas = ref(null);
const textoMeme = ref(null);
const colorTexto = ref("#000000");
const colorBorde = ref("#FFFFFF");
const fontSize = ref(30);
const strokesize = ref(5);
const fontFamily = ref("Arial");
const drawing = ref(false);
const brushWidth = ref(10);
const brushColor = ref("#000000");
const formColor = ref("#000000");

//Variable que contiene el meme resultante
const form = useForm({
    imagen: '',
});

//Listado de fuentes
const fontList = [
  "Arial",
  "Helvetica",
  "Times New Roman",
  "Georgia",
  "Verdana",
  "Courier New",
  "Palatino",
  "Tahoma",
  "Impact",
  "Comic Sans MS",
  "Trebuchet MS",
  "Courier",
  "Lucida Console",
  "Calibri",
  "Garamond",
  "Brush Script MT",
  "Copperplate",
  "Book Antiqua",
  "Franklin Gothic Medium",
  "Century Gothic",
];

//Inicializa el canvas al cargar el componente
onMounted(() => {
  canvas.value = new fabric.Canvas(canvasRef.value, {
    width: 700,
    height: 600,
    preserveObjectStacking: true, //superpone la imagen ante el texto
    isDrawingMode: drawing.value,
  });
  canvas.value.freeDrawingBrush.width = brushWidth.value;
  canvas.value.freeDrawingBrush.color = brushColor.value;
});

//Activa o desactiva el modo dibujo
const changeMode = computed(() => {
  
  canvas.value.isDrawingMode = drawing.value;
  
});

//Tamaño de la lapiz
const changeBrushWidth = () => {
  let size = parseInt(brushWidth.value, 10);
  canvas.value.freeDrawingBrush.width = size;
  canvas.value.requestRenderAll();

}

//Color de la lapiz
const changeBrushColor = () => {
  let color = brushColor.value
  canvas.value.freeDrawingBrush.color = color;
  canvas.value.requestRenderAll();
}

//Color de las formas (rectangulo, circulo y flecha)
const changeFormColor = () => {
  let selectedcolor = formColor.value;
  let activeObject = canvas.value.getActiveObject();

  if (activeObject && (activeObject.type === 'rect' || activeObject.type === 'circle')) {
    activeObject.set('stroke', selectedcolor);
    canvas.value.requestRenderAll();
  }

  if(activeObject && activeObject.type === 'group'){

    activeObject._objects[0].set('stroke',selectedcolor);
    activeObject._objects[1].set('fill',selectedcolor);
    canvas.value.requestRenderAll();

  }
}

//Agrega un rectangulo
const addRectangle = () => {

  const rect = new fabric.Rect({
    top:150,
    left:150,
    width:300,
    height:200,
    fill: 'rgba(0,0,0,0)',
    stroke: formColor.value,
    strokeWidth: 5,
    cornerSize: 15,
    cornerStyle: "circle",
  })

  canvas.value.add(markRaw(rect)).setActiveObject(markRaw(rect));

}

//Agrega un circulo
const addCircle = () => {

  const circle = new fabric.Circle({
    top: 0,
    left: 0,
    radius: 200,
    stroke: formColor.value,
    strokeWidth: 8,
    fill: 'rgba(0,0,0,0)'
  })

  canvas.value.add(markRaw(circle)).setActiveObject(markRaw(circle));

}

const fileInput = ref(null); //variable ref para el input file

//Agrega una imagen al canvas
const handleFileChange = () => {
  canvas.value.discardActiveObject();
  let img = fileInput.value.files[0];
  if (!img) {
    return;
  }

  let reader = new FileReader();
  reader.onload = function (e) {
    let data = reader.result;
    fabric.Image.fromURL(data, function (img) {
      canvas.value.add(markRaw(img));
      if (img.width > canvas.value.width) {
        img.scaleToWidth(canvas.value.width);
      }
      if (img.height > canvas.value.height) {
        img.scaleToHeight(canvas.value.height);
      }

      //canvas.value.sendToBack(img);
    });
  };
  reader.readAsDataURL(img);
  fileInput.value.value = ''; //resetea lo que contiene el input file
  
};

//Agrega un texto
const addText = () => {
  canvas.value.discardActiveObject(); //desactiva el objeto activo

  //IText or Textbox inline edit text
  if (textoMeme.value) {
    let text = new fabric.IText(textoMeme.value, {
    left: 100,
    top: 100,
    fontSize: fontSize.value,
    fill: colorTexto.value,
    fontFamily: fontFamily.value,
    stroke: colorBorde.value,
    strokeWidth: strokesize.value,
    paintFirst: 'stroke',
  });
    canvas.value.add(markRaw(text)).setActiveObject(markRaw(text)); //agrega el texto y activa el objeto
    text.bringToFront(); //superpone el texto
    textoMeme.value = null;
  }
};

//Cambia el tipo de fuente del texto seleccionado
const changeFontInlne = () => {

  let selectedfont = fontFamily.value;
  let activeObject = canvas.value.getActiveObject();
  
  if (activeObject && activeObject.type === 'i-text') {
    activeObject.set('fontFamily', selectedfont);
    canvas.value.requestRenderAll();
  }
}


//Cambia el color del texto seleccionado
const changeColorInline = () => {

  let selectedcolor = colorTexto.value;
  let activeObject = canvas.value.getActiveObject();

  if (activeObject && activeObject.type === 'i-text') {
    activeObject.set('fill', selectedcolor);
    canvas.value.requestRenderAll();
  }

}

//Cambia el color del borde del texto seleccionado
const changeStrokeColorInline = () => {

  let selectedcolor = colorBorde.value;
  let activeObject = canvas.value.getActiveObject();

  if (activeObject && activeObject.type === 'i-text') {
    activeObject.set('stroke', selectedcolor);
    canvas.value.requestRenderAll();
  }

}

//Cambia el tamaño del texto seleccionado
const changeFontsizeInline = () => {

  let size = parseInt(fontSize.value, 10);
  let activeObject = canvas.value.getActiveObject();

  if (activeObject && activeObject.type === 'i-text') {
    activeObject.set('fontSize', size);
    canvas.value.requestRenderAll();
  }

}

//Cambia el tamaño del borde del texto seleccionado
const changeStrokeSizeInline = () => {

  let size = parseInt(strokesize.value, 10);
  let activeObject = canvas.value.getActiveObject();

  if (activeObject && activeObject.type === 'i-text') {
    activeObject.set('strokeWidth', size);
    canvas.value.requestRenderAll();
  }

}

//Borra el o los objetos seleccionado/s con la tecla "Delete"
window.addEventListener("keydown", (e) => {
  if (e.key === "Delete") {
    const activeObjects = canvas.value.getActiveObjects();
    if (activeObjects) {
      activeObjects.forEach((object) => {
        canvas.value.remove(object);
      });
      canvas.value.discardActiveObject().renderAll();
    }
  }
});

//Borra solamente el dibujo trazado en el canvas
const borrarDibujo = () =>{
  let objects = canvas.value.getObjects();
  if(objects){
    objects.forEach((object) => {
      if(object.type === 'path'){
        canvas.value.remove(object); 
      }
    })
  }
}

//Descarga el meme resultante
const descargarMeme = () => {
  let dataURL = canvas.value.toDataURL();
  let link = document.createElement("a");
  link.href = dataURL;
  link.download = "meme.png";
  link.click();
};

//Guarda el meme en la base de datos
const guardarGaleria = () => {
    form.imagen = canvas.value.toDataURL();
    form.post(route('meme.save'));
};

//Agrega un flecha
const addArrow = () => {
  const triangle = new fabric.Triangle({
  width: 10, 
  height: 15, 
  fill: formColor.value, 
  left: 235, 
  top: 65,
  angle: 90
});
const line = new fabric.Line([50, 100, 200, 100], {
  left: 75,
  top: 70,
  stroke: formColor.value,
});

const objs = [line, triangle];

const alltogetherObj = new fabric.Group(objs);

canvas.value.add(markRaw(alltogetherObj)).setActiveObject(markRaw(alltogetherObj));

}

//Limpia el canvas
const clearAll = () => {
  canvas.value.clear();
  canvas.value.discardActiveObject().renderAll();
}

</script>

<template>
  <Head title="Crear Meme" />
  <div class="bg-celeste">
    <header class="bg-lila">
      <div class="shrink-0 flex justify-center">
        <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
          <span class="uppercase text-5xl font-ibm font-bold text-white"
            >meme generator</span
          >
        </div>
      </div>
    </header>
    <div class="mt-3 flex justify-center items-center">
      <div class="-mt-1 mb-2">
        <Link
          as="button"
          :href="route('meme.index')"
          class="bg-[#00F1FF] hover:bg-[#34b1b8] px-3 py-1 rounded-[4px] border-2 border-black"
        >
          <span class="font-ibm uppercase font-bold text-2xl">ver Galeria</span>
        </Link>
      </div>
    </div>
    <div class="flex justify-center h-screen overflow-hidden flex-row">
      <div class="bg-white h-fit flex flex-row space-x-3 p-3 rounded-md">
        <div class="space-y-2">
          <div class="space-x-2 items-center flex">
              <input
                id="drawing"
                @change="changeMode"
                type="checkbox"
                v-model="drawing"
              />
              <label class="font-ibm font-bold text-base uppercase" for="drawing">Modo dibujo</label>
          </div>
          <div class="bg-black/10 p-2 mt-3 rounded-[4px] space-y-2">
            <div class=" flex flex-col">
              <label class="font-ibm font-bold text-base uppercase" for="brushWidth">&#8595 Ancho de linea &#8595</label>
              <input
                  id="brushWidth"
                  class="cursor-pointer w-full"
                  v-model="brushWidth"
                  @change="changeBrushWidth"
                  step="1"
                  type="range"
                  min="1"
                  max="100"
                />
            </div>
            <div class="items-center flex flex-col">
                  <label
                    for="brushColor"
                    class="font-bold font-ibm text-base uppercase"
                  >
                   &#8595 Color de linea &#8595
                  </label>
                  <input
                    id="brushColor"
                    class="w-full cursor-pointer"
                    type="color"
                    v-model="brushColor"
                    @change="changeBrushColor"
                  />
            </div>
          </div>
          <div class="flex justify-center">
            <span class="font-ibm font-bold text-base uppercase">FORMAS</span>
          </div>
          <div class="bg-black/10 p-2 rounded-[4px] space-y-3">
            <div class="flex justify-center">
                <button
                @click="addCircle"
                  class="w-full bg-[#f4d738] py-2 rounded-[4px] border-2 border-black hover:bg-[#e3a018]"
                >
                  <span class="font-ibm font-bold text-base uppercase"
                    >circulo &#128992</span
                  >
                </button>
              </div>
            <div class="flex justify-center">
                <button
                  @click="addRectangle"
                  class="w-full bg-[#f4d738] py-2 rounded-[4px] border-2 border-black hover:bg-[#e3a018]"
                >
                  <span class="font-ibm font-bold text-base uppercase"
                    >rectangulo &#128999</span
                  >
                </button>
            </div>
            <div class="flex justify-center">
                <button
                  @click="addArrow"
                  class="w-full bg-[#f4d738] py-2 rounded-[4px] border-2 border-black hover:bg-[#e3a018]"
                >
                  <span class="font-ibm font-bold text-base uppercase"
                    >flecha</span><span class="text-orange-500"> &#129034</span>
                </button>
            </div>
            <div class="items-center flex flex-col">
                  <label
                    for="formColor"
                    class="font-bold font-ibm text-base uppercase"
                  >
                   &#8595 Color de formas &#8595
                  </label>
                  <input
                    id="formColor"
                    class="w-full cursor-pointer"
                    type="color"
                    v-model="formColor"
                    @input="changeFormColor"
                  />
            </div>
          </div>
          <div class="flex justify-center py-2">
              <button
                @click="borrarDibujo"
                class="w-full bg-[#ff7a5c] py-2 rounded-[4px] border-2 border-black hover:bg-[#ff6b6b]"
              >
                <span class="font-ibm font-bold text-base uppercase"
                  >borrar dibujo</span>
              </button>
          </div>
          <div class="flex justify-center">
              <button
                @click="clearAll"
                class="w-full bg-[#ff7a5c] py-2 rounded-[4px] border-2 border-black hover:bg-[#ff6b6b]"
              >
                <span class="font-ibm font-bold text-base uppercase"
                  >borrar todo</span>
              </button>
          </div>
        </div>
        <div>
          <canvas class="border-2 border-black" ref="canvasRef"></canvas>
        </div>
        <div>
          <div class="flex flex-col text-center">
            <label
              for="file-input"
              class="cursor-pointer text-lg px-4 py-2 bg-[#00F1FF] text-black border-2 border-black rounded-[4px] font-ibm uppercase font-bold hover:bg-[#69d2e7]"
            >
              Subir Imagen
            </label>
            <input
              ref="fileInput"
              @change="handleFileChange"
              id="file-input"
              type="file"
              class="hidden"
            />
          </div>
          <div class="bg-black/10 p-2 mt-3 rounded-[4px] space-y-3">
            <div>
              <textarea
                class="w-full caret-blue-400 rounded-md font-ibm bg-gray-200 focus:bg-gray-300"
                id="textoMeme"
                v-model="textoMeme"
                placeholder="Escribe tu Meme"
              ></textarea>
            </div>
            <div class="flex flex-row space-x-3">
              <div class="items-center flex flex-col">
                <label
                  for="colorTexto"
                  class="font-bold font-ibm text-sm uppercase"
                >
                 &#8595 Color de texto &#8595
                </label>
                <input
                  id="colorTexto"
                  class="w-full cursor-pointer"
                  v-model="colorTexto"
                  @input="changeColorInline"
                  type="color"
                />
              </div>
              <div class="items-center flex flex-col">
                <label
                  for="colorBorde"
                  class="font-bold font-ibm text-sm uppercase"
                >
                 &#8595 color de borde &#8595
                </label>
                <input
                  id="colorBorde"
                  class="w-full cursor-pointer"
                  @input="changeStrokeColorInline"
                  v-model="colorBorde"
                  type="color"
                />
              </div>
            </div>
            <div class="items-center flex flex-col mt-1">
              <label
                for="fontsize"
                class="font-bold font-ibm text-lg uppercase"
              >
                <span> &#8595 Tamaño Fuente:</span
                ><span class="text-lime-600">{{ fontSize }}</span
                ><span>px &#8595</span>
              </label>
              <input
                id="fontsize"
                class="w-full cursor-pointer"
                v-model="fontSize"
                type="range"
                @change="changeFontsizeInline"
                min="30"
                max="200"
              />
            </div>
            <div class="items-center flex flex-col mt-1">
              <label
                for="strokesize"
                class="font-bold font-ibm text-lg uppercase"
              >
                <span> &#8595 Tamaño Borde:</span
                ><span class="text-lime-600">{{ strokesize }}</span
                ><span>px &#8595</span>
              </label>
              <input
                id="strokesize"
                class="w-full cursor-pointer"
                v-model="strokesize"
                type="range"
                @change="changeStrokeSizeInline"
                min="1"
                max="30"
                step="1"
              />
            </div>
            <div class="items-center flex flex-col mt-1">
              <label
                for="fontFamily"
                class="font-bold font-ibm text-lg uppercase"
              >
                <span>Seleccionar Fuente</span>
              </label>
              <select
                id="fontFamily"
                class="w-full border-2 border-black"
                v-model="fontFamily"
                @change="changeFontInlne"
              >
                <option v-for="font in fontList" :key="font" :value="font">
                  {{ font }}
                </option>
              </select>
            </div>
            <div class="flex justify-center mt-2">
              <button
                @click="addText"
                class="w-full bg-[#f4d738] py-2 rounded-[4px] border-2 border-black hover:bg-[#e3a018]"
              >
                <span class="font-ibm font-bold text-lg uppercase"
                  >Agregar Texto</span
                >
              </button>
            </div>
          </div>
          <div class="mt-5 space-y-3">
            <div class="text-center ">
              <button
                @click="descargarMeme"
                class="bg-[#90ee90] w-full py-2 rounded-[4px] border-2 border-black hover:bg-[#7fbc8c]"
              >
                <span class="font-ibm font-bold text-lg uppercase"
                  >Descargar meme</span
                >
              </button>
            </div>
            <div class="text-center ">
              <button
                @click="guardarGaleria"
                class="bg-[#90ee90] w-full py-2 rounded-[4px] border-2 border-black hover:bg-[#7fbc8c]"
              >
                <span class="font-ibm font-bold text-lg uppercase"
                  >Guardar en Galeria</span
                >
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
