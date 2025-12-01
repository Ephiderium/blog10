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
        <button @click="like" style="color: crimson;">♥</button>
        <button @click="dislike(likeId)" style="color: black;">♥</button>
        <p>Количество комментариев: {{ post.comments_count }}</p>
        <p>Количество лайков: {{ post.likes }}</p>
        <p>Комментарии:</p>
        <div
            v-for="comment in post.comments"
            style="border: 2px solid; border-color: red; margin: 3px"
        >
            <p>Автор: {{ comment.author }} </p>
            <p>{{ comment.body }}</p>
            <button @click="deleteComment(comment.id)">Удалить</button>
            <button @click="switchUpdateComment = true">Обновить</button>
            <div v-if="switchUpdateComment">
                    <form @submit.prevent="updateComment(comment.id, bodyCommentUpdate)">
                        <input v-model="bodyCommentUpdate" placeholder="Введите текст"></input>
                        <button type="submit">Применить</button>
                    </form>
            </div>
        </div>
        <div>
            <p>Создание комментария</p>
            <form @submit.prevent="createComment()">
                <input v-model="bodyComment"></input>
                <button type="submit">Подтвердить</button>
            </form>
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
const model = "post"
const bodyComment = ref(null)
const bodyCommentUpdate = ref(null)
const switchUpdateComment = ref(false);
const dataLike = reactive({ likeable_id: postId, likeable_type: model})
const likeId = ref(null);

async function getPost() {
    isLoading.value = true;
    const response = await api.get(`/posts/${postId}`);
    post.value = response.data.data;
    isLoading.value = false;
}

 function createComment()
{
    const dataComment = { model_id: postId, model_type: model, body: bodyComment.value, category: 'PHP' }
    const response_cc = api.post('/comments', dataComment)
}

 function updateComment(id, body)
{
    const data = { body: body }
    const response_uc = api.patch('/comments/' + id, data)
    switchUpdateComment.value = false
}

 function deleteComment(id)
{
    const response_dc = api.delete('/comments/' + id)
}

async function like()
{
    const response_l = await api.post('/likes', dataLike)
    likeId.value = response_l.data.data.id
}

async function dislike(id)
{
    if (id != null) {
    const response_dl = await api.delete('/likes/' + id)
    console.log(response_dl)
    } else {
        console.log('Нет id')
    }
}

onMounted(async () => {
    getPost();
});
</script>
