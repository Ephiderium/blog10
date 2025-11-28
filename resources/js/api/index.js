import axios from "axios";

const api = axios.create({
    baseURL: "http://127.0.0.1:8000/api/",
    timeout: 3600,
    withCredentials: true,
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
    },
});

api.interceptors.request.use(async (config) => {
    if (
        ["post", "put", "delete", "patch"].includes(
            config.method?.toLowerCase()
        )
    ) {
        const hasXsrfToken = document.cookie.includes("XSRF-TOKEN");
        if (!hasXsrfToken) {
            await api.get("/sanctum/csrf-cookie");
        }
    }
    return config;
});

export default api;
