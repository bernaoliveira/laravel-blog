import {ref} from "vue";
import {useRoute, useRouter} from "vue-router";

export function useArticles() {
    const route = useRoute();
    const router = useRouter();

    const articles = ref([]);
    const page = ref(route.query.page ? parseInt(route.query.page) : 1);
    const total = ref(0);

    const fetchArticles = async (filters) => {
        const params = new URLSearchParams({
            with_relation_user: true,
            with_relation_categories: true,
            limit: 20,
            offset: (page.value - 1) * 20,
            ...filters,
        });

        try {
            const response = await fetch(`http://localhost/api/articles?+${params}`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                },
            });

            const data = await response.json();
            articles.value = data.result;

            total.value = data.total;
        } catch (error) {
            console.error(error);
        }
    }

    const changePage = async (newPage, filters) => {
        page.value = newPage;

        const query = { ...route.query, page: newPage };
        await router.push({query});

        await fetchArticles(filters);
    }

    return { articles, fetchArticles, changePage, page, total };
}
