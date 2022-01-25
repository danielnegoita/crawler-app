var app = new Vue({
    el: '#app',

    delimiters: ['${', '}'],

    data: {
        isCrawling: false,
        hasSuccess: false,
        hasErrors: false,
        links: []
    },

    computed: {
        linksCount: function() {
            return this.links.length;
        }
    },

    created: function() {
        this.getStats();
        this.getErrors();
    },

    methods: {
        getStats() {
            //TODO
        },

        getErrors() {
            //TODO
        },

        crawlHomepage() {
            var formData = new FormData();
            formData.append('url', window.routes.homepageAbsolute);

            this.crawlPage(formData);
        },

        crawlPage: function(data) {
            var vm = this;

            this.isCrawling = true;
            this.hasErrors = false;
            this.hasSuccess = false;

            fetch(window.routes.crawl, {
                method: 'POST',
                body: data
            })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {

                    vm.links = data;
                    vm.hasSuccess = true;

                    setTimeout(function() {
                        vm.closeSuccessAlert();
                    }, 3000);

                })
                .catch(function(error) {
                    vm.hasErrors = true;
                    vm.fetchErrors();
                    console.error(error);
                })
                .finally(function() {
                    vm.isCrawling = false;
                });
        },

        fetchErrors: function() {
            //TODO: get errors from DB
        },

        closeErrorAlert: function() {
            this.hasErrors = false;
        },

        closeSuccessAlert: function() {
            this.hasSuccess = false;
        }
    }
});