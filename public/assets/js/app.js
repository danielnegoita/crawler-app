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
        this.fetchStats();
        this.fetchIssues();
    },

    methods: {
        fetchStats() {
            var vm = this;

            this.reset();

            fetch(window.routes.stats + '?url=' + window.routes.homepageAbsolute)
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    vm.links = data;
                })
                .catch(function(error) {
                    vm.hasErrors = true;
                    vm.fetchIssues();
                    console.error(error);
                });
        },

        crawlHomepage() {
            this.crawlPage(window.routes.homepageAbsolute);
        },

        crawlPage: function(url) {
            var vm = this;

            this.reset();

            this.isCrawling = true;

            fetch(window.routes.crawl + '?url=' + url)
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
                    vm.fetchIssues();
                    console.error(error);
                })
                .finally(function() {
                    vm.isCrawling = false;
                });
        },

        fetchIssues: function() {
            //TODO: get errors from DB
        },

        closeErrorAlert: function() {
            this.hasErrors = false;
        },

        closeSuccessAlert: function() {
            this.hasSuccess = false;
        },

        reset() {
            this.isCrawling = false;
            this.hasErrors = false;
            this.hasSuccess = false;
        }
    }
});