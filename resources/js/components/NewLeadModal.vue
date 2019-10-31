<template>
   <modal name="new-lead" height="auto" classes="p-5 card rounded-lg">
       <h1 class="class mx-auto font-semibold text-blue-700 text-lg text-center w-full">Add New Lead</h1>

       <form @submit.prevent="submit" class="w-10/12 mx-auto py-5">
           <div class="mb-4">
               <label for="name" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider mb-1">Name</label>

               <input type="text" id="name" name="name"
                      class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                      :class="form.errors.name ? 'border-red-500' : 'border-gray-500'"
                      placeholder="John Doe"
                      v-model="form.name"
               >
               <span class="text-xs italic text-red-700" v-if="form.errors.name" v-text="form.errors.name[0]"></span>
           </div>

           <div class="mb-6">
               <label for="email" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider">Email</label>

               <input type="text" id="email" name="email"
                      class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm block w-full focus:outline-none focus:border-blue-300"
                      :class="form.errors.email ? 'border-red-500' : 'border-gray-500'"
                      placeholder="john@example.com"
                      v-model="form.email"
               >
               <span class="text-xs italic text-red-700" v-if="form.errors.email" v-text="form.errors.email[0]"></span>
           </div>


           <div class="mb-4 flex items-center justify-between">

               <div class="flex items-center justify-between">
                   <label for="name" class="label text-gray-600 font-semibold uppercase text-xs tracking-wider mr-2">Phone</label>
                   <input type="text" id="country_code" name="country_code"
                          class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm w-full focus:outline-none focus:border-blue-300"
                          :class="form.errors.country_code ? 'border-red-500' : 'border-gray-500'"
                          placeholder="+254"
                          v-model="form.country_code"
                   >
                   <span class="text-xs italic text-red-700" v-if="form.errors.country_code" v-text="form.errors.country_code[0]"></span>
               </div>

               <div class="flex-1 ml-4">
                   <input type="text" id="phone_number" name="phone_number"
                          class="input bg-white border border-gray-100 rounded py-2 px-4 text-sm text-gray-800 text-xm w-full focus:outline-none focus:border-blue-300"
                          :class="form.errors.phone_number ? 'border-red-500' : 'border-gray-500'"
                          placeholder="712 345 678"
                          v-model="form.phone_number"
                   >
                   <span class="text-xs italic text-red-700" v-if="form.errors.phone_number" v-text="form.errors.phone_number[0]"></span>
               </div>
           </div>

<!--           <vue-tel-input-->
<!--               v-model="phone"-->
<!--               inputClasses="focus:outline-none focus:border-blue-300 py-2 px-4"-->
<!--               wrapperClasses="focus:outline-none focus:border-blue-300 outline-none"-->
<!--               defaultCountry="KE"-->
<!--               mode="international"-->
<!--               name="phone">-->
<!--           </vue-tel-input>-->

           <footer class="flex justify-end">
               <button type="button" class="btn btn-gray mr-4 text-xs" @click="$modal.hide('new-lead')">Cancel</button>

               <button class="btn btn-success text-xs">Submit</button>
           </footer>
       </form>
   </modal>
</template>

<script>
    import CrmForm from './CrmForm'

    export default {
        name: 'new-lead-modal',

        data() {
            return {
                form: new CrmForm({
                    name: '',
                    country_code: '',
                    phone_number: '',
                    email: '',
                }),
            }
        },

        methods: {
            submit() {
                this.form.submit('/leads')
                    .then(response => {
                         this.emit(response.data.message);

                         this.hide();
                    });
            },

            emit(message) {
                Event.fire('flash-message', message);
            },

            hide() {
               this.$modal.hide('new-lead');

               this.form.reset();
            }
        }
    }
</script>

<style scoped>

</style>
