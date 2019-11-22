export default {
    data() {
      return {
          items: []
      }
    },

    created() {
        this.addItem()
    },

    methods: {
        removeItem(index, id) {
            let endpoint = location.pathname + "/" + id;

            axios.delete(endpoint)
                .then(response => {
                    this.items.splice(index, 1);

                    this.flash(response.data.message);
                });
        },

        flash(message) {
            Event.fire('flash-message', message);
        },

        addItem() {
            Event.listen('itemAdded', item => this.items.unshift(item))
        },
    }
}
