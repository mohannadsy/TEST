<script setup>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
</script>

<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                        <table>
                            <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Website</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ajay</td>
                                    <td>Malhotra</td>
                                    <td>Therichpost.com</td>
                                </tr>
                                <tr>
                                    <td>Ajay</td>
                                    <td>Malhotra</td>
                                    <td>Therichpost.com</td>
                                </tr>
                            </tbody>
                            <button v-print>Print the entire page</button>

                            <div id="printMe" style="background: red">
                                <p>رغد</p>
                                <p>u made me hate this city</p>
                                <p>
                                    and i dont talk shit about u on the internet
                                </p>
                            </div>
                            <button v-print="'#printMe'">Print local range</button>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<style>
table {
    border: 2px solid black;
}
@media print {
    html,
    body {
        height: inherit;
        border: 2px solid red;
    }
}
</style>
