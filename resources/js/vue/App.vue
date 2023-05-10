<script>
export default {
    data() {
        return {
            articulosVigentes: [],
            idItmArticuloSeleccionado: '',

            articulosCargados: [],

            pedidosNoSincronizados: [],
            pedidosGuardados: [],
        }
    },
    async created() {

        const storage = localStorage.getItem('pedidosNoSincronizados');
        this.pedidosNoSincronizados = storage ? JSON.parse(storage) : [];

        try {
            fetch(`campanias/1/articulos`);
            const response = await axios.get(`campanias/1/articulos`);
            this.articulosVigentes = response.data;
        } catch (error) {
            alert(`Error al obtener articulos: ${error.response.data}`);
        }
    },
    methods: {
        agregarArticulo() {
            if (this.idItmArticuloSeleccionado == '')
                return;

            const articulo = this.articulosVigentes.find(a => a.idItmArticulo == this.idItmArticuloSeleccionado);
            this.articulosCargados.push( articulo );
        },
        agregarPedido(){
            if( this.articulosCargados.length === 0 )
                return;

            const pedido = {
                articulos: [...this.articulosCargados],
            };

            this.pedidosNoSincronizados.push( pedido );
            localStorage.setItem('pedidosNoSincronizados', JSON.stringify(this.pedidosNoSincronizados));
            this.articulosCargados = [];
        },
        aiuda(){
            console.log('aiuda');
            fetch('campanias/1/articulos');
        },
    },
}
</script>

<template>
    <div class="max-w-[800px] p-5 mx-auto space-y-10">
        <h1 class="text-3xl">Test carga offline</h1>

        <section id="nuevo-pedido">
            <form @submit.prevent="agregarArticulo">
                <select v-model="idItmArticuloSeleccionado" class="p-2 border border-solid border-gray-100 rounded-md me-3">
                    <option value="">Seleccione artículo</option>
                    <option v-for="articulo in articulosVigentes" :value="articulo.idItmArticulo">{{ articulo.codigo }}</option>
                </select>
                <button
                    class="bg-blue-500 rounder border border-solid py-2 px-4 rounded-md text-white font-bold">Agregar</button>
            </form>

            <div id="articulos-cargados">
                <header class="flex items-center">
                    <h2 class="p-4 me-5">Artículos cargados</h2>
                    <button @click="agregarPedido" class="bg-blue-500 rounder border border-solid py-2 px-4 rounded-md text-white font-bold">Guardar Pedido</button>
                </header>
                <ul>
                    <li v-for="articuloCargado in articulosCargados">
                        {{ articuloCargado.codigo }}
                    </li>
                </ul>
            </div>
        </section>
        <section id="pedidos-no-sincronizados">
            <header class="flex items-center mb-5">
                <h2 class="me-4">Pedidos no sincronizados</h2>
                <button @click="sincronizarPedidos" class="bg-blue-500 rounder border border-solid py-2 px-4 rounded-md text-white font-bold">Sincronizar</button>
            </header>
            <ul>
                <li v-for="pedidoNoSincronizado in pedidosNoSincronizados">
                    <strong class="font-bold text-red-800 me-3">NO SINCRONIZADO</strong>
                    <span>Unidades: {{ pedidoNoSincronizado.articulos.length }} </span>
                </li>
            </ul>
        </section>
        <section id="pedidos-guardados">
            <header>
                <h2>Pedidos guardados</h2>
            </header>
            <ul>
                <li v-for="pedidoGuardado in pedidosGuardados">
                    <strong class="font-bold text-green-800 me-3">SINCRONIZADO</strong>
                    <span>Unidades: {{ pedidoGuardado.articulos.length }} </span>
                </li>
            </ul>
        </section>
    </div>
    <button @click="aiuda">FF</button>
</template>

<style></style>