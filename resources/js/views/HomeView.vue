<template>
    <div v-for="post in posts" :key="post.id" style="border: 3px solid; border-color: blue; margin-bottom: 3px;">
        <div>Заголовок:</div>
        <textarea>{{ post.title }}</textarea>
        <div>Содержание:</div>
        <textarea>{{ post.content }}</textarea>
        <div>Категория:</div>
        <textarea>{{ post.category }}</textarea>
        <div>Автор:</div>
        <textarea>{{ post.author.name }}</textarea>
    </div>
</template>

<script setup>
import { ref, reactive } from "vue"
import api from "../api/index.js";

const posts = ref(null)
const isLoading = ref(false)

async function getPosts ()
{
    isLoading.value = true
    const response = await api.post('/posts')
    posts.value = response.data.data
    isLoading.value = false
}

getPosts()
</script>
