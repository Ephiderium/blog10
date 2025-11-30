<template>
    <div>
        <label for="update">Редактирование поста</label>
        <form @submit.prevent="update" id="update">
            <input v-model="form.title" placeholder="title"></input>
            <input v-model="form.content" placeholder="content"></input>
            <button type="submit">Принять</button>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue"
import api from "../api/index.js";
import { useRoute } from 'vue-router'

const route = useRoute()
const postId = route.params.id
const isLoading = ref(false)
const form = reactive({
    title: null,
    content: null,
})

async function update()
{
    const response = await api.patch('/posts/' + postId, form)
    console.log(response.data)
}
</script>
