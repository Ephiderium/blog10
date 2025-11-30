<template>
    <div>
        <label for="create">Создание поста</label>
        <form @submit.prevent="create" id="create">
            <input v-model="form.title" placeholder="title"></input>
            <input v-model="form.content" placeholder="content"></input>
            <select v-model="form.category" id="category" name="category">
                <option v-for="category in categories">{{ category }}</option>
            </select>
            <button type="submit">Принять</button>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from "vue"
import api from "../api/index.js";

const isLoading = ref(false)
const form = reactive({
    title: '',
    comtent: '',
    category: ''
})
const categories = ref(null);

async function create()
{
    const response = await api.post('/store', form)
    console.log(response.data.data)
}

async function getCategories()
{
    const res = await api.get('/categories')
    categories.value = res.data.categories
}

onMounted(() => {
    getCategories()
})
</script>
