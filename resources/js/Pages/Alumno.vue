<script setup>
import {ref} from 'vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';

const iframeDocumento = ref(null);

const form = useForm({
    nombre: '',
    tipo: '',
    documento: null
});


const submit = () => {
    form.post(route('alumno.subir-actividad'), {
        onFinish: () => {
            form.reset();
        },
    });
};

const reset = () => {
    form.reset();
};

const updateDocumento = ($event) => {
    const file = $event.target.files[0];
    form.documento = file;
    const reader = new FileReader();
    var filename = form.documento.name;

    reader.addEventListener(
        "load",
        function () {
            iframeDocumento.value.src = reader.result;
        },
        false
    );

    if (file) {
        reader.readAsDataURL(file);
    }
}

</script>

<template>
    <Head title="Alumno"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Alumno
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="grid grid-cols-2">
                            <div class="p-6">
                                <form @submit.prevent="submit">
                                    <div>
                                        <BreezeLabel for="nombre" value="Nombre"/>
                                        <BreezeInput id="nombre" type="text" class="mt-1 block w-full"
                                                     v-model="form.nombre" required/>
                                    </div>
                                    <div>
                                        <BreezeLabel for="tipo" value="Tipo"/>
                                        <select id="tipo" class="w-full mt-1 block border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" v-model="form.tipo" required>
                                            <option></option>
                                            <option value="tg">TG</option>
                                            <option value="ps">PS</option>
                                        </select>
                                    </div>
                                    <div class="mt-4">
                                        <BreezeInput id="documento" type="file" class="mt-1 block w-full"
                                                     @input="updateDocumento($event)" required/>
                                    </div>

                                    <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                        {{ form.progress.percentage }}%
                                    </progress>

                                    <div class="flex items-center justify-start mt-4">
                                        <BreezeButton class="ml-4"
                                                      :class="{ 'opacity-25': form.processing }"
                                                      :disabled="form.processing">
                                            Guardar
                                        </BreezeButton>
                                        <BreezeButton class="ml-4" onClick="reset">
                                            Eliminar
                                        </BreezeButton>
                                    </div>
                                </form>

                                <BreezeValidationErrors class="mt-4" />
                            </div>
                            <div class="p-6 flex">
                                <iframe ref="iframeDocumento" class="w-full" src="about:blank"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
