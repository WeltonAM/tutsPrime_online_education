<template>
    <div class="d-flex flex-col align-items-center justify-content-between">
        <button :disabled="isFirst" @click="prev" class="btn btn-outline-secondary">Newer</button>

        <div>{{ pagesInfo }}</div>

        <button :disabled="isLast" @click="next" class="btn btn-outline-secondary">Older</button>
    </div>
</template>

<script>
export default {
    props: ['meta', 'links'],

    computed: {
        pagesInfo () {
            let currentPage = this.meta.current_page || 1,
                lastPage = this.meta.last_page || 1;

            return `Page ${currentPage} of ${lastPage}`
        },

        isFirst () {
            return this.meta.current_page === 1;
        },

        isLast () {
            return this.meta.current_page === this.meta.last_page;
        }
    },

    methods: {
        switchPage () {
            this.$router.push({
                name: 'questions',
                query: {
                    page: this.meta.current_page
                },
            });
        },

        prev () {
            if (! this.isFirst) {
                this.meta.current_page--;
            }
            this.switchPage();
        },

        next () {
            if (! this.isLast) {
                this.meta.current_page++;
            }

            this.switchPage();
        }
    }
}
</script>
