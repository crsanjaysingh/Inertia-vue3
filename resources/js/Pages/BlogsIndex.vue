<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import NavLink from '@/Components/NavLink.vue';
import { Link, Head } from '@inertiajs/vue3';
</script>
<template>    
    <Head>
      <!-- <title>{{title}}</title>
      <meta name="description" :content="metaDescription" head-key="description">
      <meta name="keywords" :content="metaKeywords" head-key="keywords">
      <meta name="robots" content="all,follow" head-key="robots"> -->
    <!-- Author -->
      <!-- <meta name="author" content="Sanjay Singh" head-key="author"> -->
	
	 
      <!-- OG meta  -->
      <!-- <meta property="og:image" content="" head-key="og:image" />
      <meta property="og:description" content="your site og description"  head-key="og:description">    
      <meta property="og:url" content="#" head-key="og:url" />
      <meta name="google-site-verification" content="google-verifaication-key"  head-key="google-site-verification" /> -->

    </Head>

<AuthenticatedLayout>
    <template #header>      
    <Link :href="route('add')" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Add
    </Link>                       
    </template>  
    <div class="px-4 py-8 md:flex-1 md:p-12 md:overflow-y-auto" scroll-region="">
      <div>
        <h1 class="mb-8 text-3xl font-bold">Blogs</h1>
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center mr-4 w-full max-w-md">
            <div class="flex w-full bg-white rounded shadow">
              <button type="button" class="focus:z-10 px-4 hover:bg-gray-100 border-r focus:border-white rounded-l focus:ring md:px-6">
                <div class="flex items-baseline">
                  <span class="hidden text-gray-700 md:inline">Filter</span>
                  <svg class="w-2 h-2 fill-gray-700 md:ml-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 961.243 599.998">
                    <path d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z"></path></svg>
                  </div>
              </button>
              <input class="relative px-6 py-3 w-full rounded-r focus:shadow-outline" autocomplete="off" type="text" name="search" placeholder="Search…"></div>
              <button class="ml-3 text-gray-500 hover:text-gray-700 focus:text-indigo-500 text-sm" type="button">Reset</button>
            </div>
            
          </div>
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
          <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
              <tr class="text-left font-bold">
                <th class="pb-4 pt-6 px-6">S.N</th>
                <th class="pb-4 pt-6 px-6">Title</th>
                <th class="pb-4 pt-6 px-6">Description</th>
                <th class="pb-4 pt-6 px-6" colspan="2">Actions</th>
              </tr>
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100" v-for="(blog, index)  in blogs" :key="blog.id">
                  <td class="border-t m-2 text-center">{{ index + 1 }}</td>
                  <td class="border-t m-2 text-left">{{ blog.title }}</td>
                  <td class="border-t m-2 text-left">{{ blog.description }}</td>                  
                  <td class="w-px border-t m-2 text-center">
                    <div class="m-4">                                                  
                      <Link :href="route('blog.edit', blog.id)" class="text-white bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                  Edit
                      </Link>                                                              
                    </div>                  
                    <div class="m-4">                                                  
                      <button @click="confirmDelete" :data-id=blog.id class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                  Delete
                      </button>                                                              
                    </div>                    
                  </td>
                </tr>                  
              </table>
            </div>
            <div class="mt-6"><div class="flex flex-wrap -mb-1">
              <div class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded">« Previous</div>
              <a class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded bg-white" href="#">1</a>              
              <a class="mb-1 mr-1 px-4 py-3 focus:text-indigo-500 text-sm leading-4 hover:bg-white border focus:border-indigo-500 rounded" href="#">Next »</a>
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
      title:'Blogs',
      metaDescription:'Blogs Meta Description',
      metaKeywords:'Latest Blog laravel',
    }
  },  
  methods: {
    async confirmDelete(event) {  
      const isConfirmed = window.confirm('Are you sure you want to delete this blog?');
      if (isConfirmed) {
        const id = event.target.getAttribute('data-id');      
        this.$inertia.delete(route('blog.destroy', id));   
      }else{
        alert('No deleted');
      }
    },
    hideFlashMessage(){
      this.showFlashMessage = !this.showFlashMessage;
    }        
  },
  props: ['blogs'], 
};
  </script>
  