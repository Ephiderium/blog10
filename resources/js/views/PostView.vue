<template>
    <div
        v-if="post"
        style="
            border: 3px solid;
            border-color: blue;
            margin-bottom: 3px;
            padding: 3px;
        "
    >
        <div>Заголовок:</div>
        <textarea>{{ post.title }}</textarea>
        <div>Содержание:</div>
        <textarea>{{ post.content }}</textarea>
        <div>Категория:</div>
        <textarea>{{ post.category }}</textarea>
        <div>Автор:</div>
        <textarea>{{ post.author.name }}</textarea>
        <div
            v-for="comment in post.comments"
            style="border: 2px solid; border-color: aqua; margin: 3px"
        >
            <textarea>{{ comment.body }}</textarea>
        </div>
        <p>Количество комментариев: {{ post.comments_count }}</p>
        <p>Количество лайков: {{ post.likes }}</p>
        <p>Комментарии:</p>
        <div
            v-for="comment in post.comments"
            style="border: 2px solid; border-color: red; margin: 3px"
        >
            <p>Автор: {{ comment.author }} </p>
            <p>{{ comment.body }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue";
import api from "../api/index.js";
import { useRoute } from "vue-router";
import { toRaw } from 'vue'

const post = ref(null);
const isLoading = ref(false);
const route = useRoute();
const postId = route.params.id;

async function getPost() {
    isLoading.value = true;
    const response = await api.get(`/posts/${postId}`);
    post.value = response.data.data;
    isLoading.value = false;
}

onMounted(async () => {
    getPost();
});
</script>
