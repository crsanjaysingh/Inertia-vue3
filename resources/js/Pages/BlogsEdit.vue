<template>
    <div>
      <h1>Edit Blog</h1>
      <form @submit.prevent="submitForm">
        <input type="text" v-model="formData.title" />
        <textarea v-model="formData.content"></textarea>
        <button type="submit">Update</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    props: ['blog'],
    data() {
      return {
        formData: {
          title: this.blog.title,
          content: this.blog.content,
        },
      };
    },
    methods: {
      async submitForm() {
        await this.$inertia.put(`/blogs/${this.blog.id}`, this.formData);
        this.$inertia.visit('/blogs');
      },
    },
  };
  </script>
  