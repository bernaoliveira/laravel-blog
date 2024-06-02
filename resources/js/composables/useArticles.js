import {ref} from "vue";

export function useArticles() {
    const articles = ref([]);
    const page = ref(1);

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
            articles.value = (await response.json()).result;
        } catch (error) {
            console.error(error);
        }
    }
  return { articles, fetchArticles, page };
}
