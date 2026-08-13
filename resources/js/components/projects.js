document.addEventListener('alpine:init', () => {
    Alpine.data('projects', () => ({
        genres: [],
        services: [],
        sectors: [],
        loop: null,
        projecs: '',
        timeout: null,
        loading: false,
        filterInFirstLoad: false,
        isFirstLoad: true,
        init() {
            this.$watch(
                () => [this.genres, this.services, this.sectors],
                ([newGenres, newServices, newSectors]) => {
                    if (!this.filterInFirstLoad && this.isFirstLoad) return;
                    clearTimeout(this.timeout);
                    this.timeout = setTimeout(() => {
                        this.filterProjects();
                        this.loading = true;
                    }, 600);
                }
            );
        },

        updateTax(termId, type) {
            this.isFirstLoad = false;
            const term = this[type];
            const termIdIndex = term.indexOf(termId);
            if (termIdIndex !== -1) {
                term.splice(termIdIndex, 1);
            } else {
                term.push(termId);
            }
            this[type] = term;
        },
        async filterProjects() {
            try {
                const formData = new FormData;
                formData.append('genres', this.genres);
                formData.append('services', this.services);
                formData.append('sectors', this.sectors);
                formData.append('action', 'filter_projects');
                formData.append('nonce', jclParams.filterProjectsNonce);
                let resp = await fetch(
                    `${jclParams.ajaxURL}`,
                    {
                        method: 'POST',
                        body: formData
                    }
                );

                if (!resp.ok) {
                    return;
                }

                const { success, data } = await resp.json();
                this.$el.querySelector('#projects-grid').innerHTML = data.html;
                this.loading = false;

            } catch (error) {
                console.error("Fetch failed:", error.message);
            }
        }
    }));
});

