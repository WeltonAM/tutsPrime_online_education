<script setup>
    import { ref, computed } from "vue";
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    // import Pagination from '@/Components/Pagination.vue';
    // import Sortable from '@/Components/Sortable.vue';
    // import Checkbox from '@/Components/Checkbox.vue';
    // import CheckAll from '@/Components/CheckAll.vue';
    // import BulkEdit from './BulkEdit.vue';
    import { Head, Link, router } from '@inertiajs/vue3';

    const selectedIds = ref([]);
    const showModal = ref(false);

    const deleteRow = (id) => {
        if (window.confirm("Are you sure?")) {
            router.delete(route('products.destroy', id), {
                preserveScroll: true
            });
        }
    };

    // const deleteSelected = () => {
    //     if (window.confirm("Are you sure to delete selected products?")) {
    //         router.delete(route('products.bulk-destroy', selectedIds.value.join(',')), {
    //             preserveScroll: true,
    //             onSuccess: () => selectedIds.value = []
    //         });
    //     }
    // };

    const props = defineProps({
        products: {
            type: Object,
            required: true
        },
        categories: {
            type: Array,
            required: true
        },
        query: {
            type: Object,
            default: () => ({
                search: ''
            })
        }
    });

    // const selectedProducts = computed(() => {
    //     return props.products.data
    //         .filter((product) => selectedIds.value.includes(product.id))
    //         .map((product) => ({ id: product.id, name: product.name }))
    // });

    // const handleSearch = (event) => {
    //     router.get(route('products.index'), {
    //         search: event.target.value
    //     });
    // };
</script>

<template>
    <Head title="Products" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-semibold leading-tight text-gray-800">Manage Products</h2>
                <Link
                    :href="route('products.create')"
                    class="
                        px-3 py-2.5 text-sm
                        font-medium text-center
                        text-white bg-blue-700
                        rounded-md hover:bg-blue-800
                        focus:ring-4 focus:outline-none
                        focus:ring-blue-300
                    "
                >
                    New Product
                </Link>
            </div>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-b">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Product name</th>

                                    <th scope="col" class="px-6 py-3">Category</th>

                                    <th scope="col" class="px-6 py-3">Price</th>

                                    <th scope="col" class="px-6 py-3">Weight</th>

                                    <th scope="col" class="px-6 py-3">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr v-for="product in products" :key="product.id" class="bg-white border-b hover:bg-gray-50">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ product.name }}</th>

                                    <td class="px-6 py-4">{{ product.brand }}</td>

                                    <td class="px-6 py-4">{{ product.price_formatted }}</td>

                                    <td class="px-6 py-4">{{ product.weight }}</td>

                                    <td class="px-6 py-4 space-x-2">
                                        <Link :href="route('products.show', product.id)" class="font-medium text-gray-600 hover:underline">Show</Link>

                                        <Link :href="route('products.edit', product.id)" class="font-medium text-blue-600 hover:underline">Edit</Link>

                                        <a href="#" class="font-medium text-red-600 hover:underline" @click.prevent="deleteRow(product.id)">Delete</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <nav class="flex items-center flex-column flex-wrap md:flex-row justify-between py-2 px-4" aria-label="Table navigation">
                            <span class="text-sm font-normal text-gray-700 mb-4 md:mb-0 block w-full md:inline md:w-auto">Showing <span class="font-semibold text-gray-700">1-10</span> of <span class="font-semibold text-gray-700">1000</span></span>
                            <ul class="inline-flex -space-x-px rtl:space-x-reverse text-sm h-8">
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">Previous</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">1</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">2</a>
                                </li>
                                <li>
                                    <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 hover:text-blue-700">3</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">4</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 hover:text-gray-700">5</a>
                                </li>
                                <li>
                                    <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-stone-400 hover:text-stone-400 cursor-not-allowed">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
