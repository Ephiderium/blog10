<template>
       <div>
        <label for="register">Вход</label>
        <form @submit.prevent="login" id="register">
            <div>
                <input v-model="form.email" type="email" placeholder="Введите почту"></input>
            </div>
            <div>
                <input v-model="form.password" type="password" minlength="6" placeholder="Введите пароль"></input>
            </div>
            <button type="submit">Подтвердить</button>
        </form>
    </div>
</template>

<script setup>
import { ref, reactive } from "vue"
import api from "../api/index.js";

const form = reactive({
    email: '',
    password: '',
})

const isLoading = ref(false)

async function login()
{
    await api.get('/sanctum/csrf-cookie');
    isLoading.value = true
    const response = await api.post('/login', form)
    isLoading.value = false;
    console.log(response.data);
}
</script>
