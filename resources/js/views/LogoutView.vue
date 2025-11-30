<template>
    <div>

    </div>
</template>

<script setup>
    import api from "../api/index.js";

    try {
    api.post('/logout');
    console.log('success');
    } catch {
    console.log('error');
    }
</script>
