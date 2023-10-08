<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Add Blog" />

    <AuthenticatedLayout>
        <template #header>            
            <a :href="route('blogs')" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Blogs</a>            
        </template>

        <div class="py-12">
          <div v-if="showFlashMessage" class="max-w-md mx-auto" id="flash_message">          
              <!-- Success Message -->
              <div   v-if="$page.props.flash_success.success"  class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Success:</strong>
                <span class="block sm:inline"> {{$page.props.flash_success.success }}</span>
                <span @click="hideFlashMessage" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                      d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.414-1.414l2.93-2.93-2.93-2.93a1 1 0 111.414-1.414l2.93 2.93 2.93-2.93a1 1 0 111.414 1.414l-2.93 2.93 2.93 2.93a1 1 0 010 1.414z"
                    />
                  </svg>
                </span>
              </div>

              <!-- Error Message -->
              <div v-if="$page.props.flash_error.error" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                <strong class="font-bold">Error:</strong>
                <span class="block sm:inline">{{$page.props.flash_error.error}}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg @click="hideFlashMessage" class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <title>Close</title>
                    <path
                      d="M14.348 14.849a1 1 0 01-1.414 0L10 11.414l-2.93 2.93a1 1 0 01-1.414-1.414l2.93-2.93-2.93-2.93a1 1 0 111.414-1.414l2.93 2.93 2.93-2.93a1 1 0 111.414 1.414l-2.93 2.93 2.93 2.93a1 1 0 010 1.414z"
                    />
                  </svg>
                </span>
              </div>
            </div>          
            <div class="m-5">
                <div class="bg-white overflow-hidden">
                    <div class="bg-white m-20">
                        <form @submit.prevent="submitForm">                            
                            <div class="mb-2">
                                <label
                                for="exampleInput7"
                                class=""
                                >Title
                            </label>
                            </div>
                            <div class="relative mb-6">
                                <input
                                type="hidden" v-model="formData.id" />                                
                                <input
                                type="text"
                                class="peer block min-h-[auto] w-full rounded border-1 outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                id="exampleInput7"
                                placeholder="title" v-model="formData.title" />
                            </div>


                            <!--Message textarea-->
                            <div class="relative mb-2">
                                <label
                                for="exampleFormControlTextarea13"
                                class=""
                                >Message
                            </label>
                            </div>                            
                            <div class="relative mb-6">
                            <textarea
                                class="peer block min-h-[auto] w-full rounded border-1 outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-200 dark:placeholder:text-neutral-200 [&:not([data-te-input-placeholder-active])]:placeholder:opacity-0"
                                id="exampleFormControlTextarea13"
                                rows="3"
                                placeholder="Description" v-model="formData.description"></textarea>
                            </div>

                            <!--Checkbox-->
                            <div class="mb-6 flex min-h-[1.5rem] items-center justify-center pl-[1.5rem]">
                                <!--Submit button-->
                                <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Send</button>                                
                            </div>
                        </form>                                     
                    </div>                    
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default { 
  data() {
    return {
      showFlashMessage: true, 
    }
  },
     
  methods: {
    async submitForm() {

        try {            
            const response = this.$inertia.put('/update', this.formData);          
        } catch (error) {            
            console.error('Error occurred during data insertion:', error);
        }      

    },
    hideFlashMessage(){
      this.showFlashMessage = false; 
    }
  }, 
  props: ['formData'],
};
</script>
