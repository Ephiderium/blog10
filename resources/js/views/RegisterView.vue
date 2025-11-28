<template>
    <div>
        <label for="register">Регистрация</label>
        <form @submit.prevent="register()" id="register">
            <div>
                <input v-model="form.name" type="text" placeholder="Введите имя"></input>
            </div>
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
    import api from "../api/index.js";
    import { ref, reactive } from "vue";

    const form = reactive({
            name: "",
            email: "",
            password: "",
        });
    const isLoading = ref(false);

    async function register() {
    await api.get('/sanctum/csrf-cookie');
    isLoading.value = true;
    const response = await api.post("/register", form);
    isLoading.value = false;
    }
</script>
