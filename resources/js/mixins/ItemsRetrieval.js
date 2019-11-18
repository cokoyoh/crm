export default  {
    data() {
        return {
            dataSet: false,
            items: [],
            endpoint: location.pathname,
        }
    },

    created() {
        this.fetch();
        Event.listen('nextPageRequested', page => this.fetch(page));
    },

    methods: {
        fetch(page = 1){
            axios.get(this.url(page))
                .then(this.refresh)
        },

        refresh({data}) {
            this.dataSet = data;

            this.items = data.data;
        },
    }
}
