<template>
    <div class="table-responsive">  
        <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>Owner Id</th>
                <th>Space Type</th>
                <th>Space location</th>
                <th>Space address</th>
                <th>Boosted</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(listing, index) in listings" :key="index">
                    <td scope="row">{{listing.id}}</td>
                    <td>{{listing.user.id}}</td>                                                                                                                                                                                   
                    <td>{{listing.space_type}}</td>                                                                                                                                                                                   
                    <td>{{listing.space_location}}</td>                                                                                                                                                                                   
                    <td>{{listing.space_address}}</td>                                                                                                                                                                                   
                    <td>{{listing.boosted ? "Boosted" : "Not boosted"}}</td>                                                                                                                                                                                   
                    <td>
                        <button type="button" class="btn btn-danger" @click="deleteL(listing.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </button>
                    </td>
                </tr>
            </tbody>
    </table>
    </div>

</template>

<script>
import { mapActions } from 'vuex'

export default {
    data () {
        return {
            listings:[]
        }
    },

    methods: {
        ...mapActions(['getAllListings','deleteList']),
         deleteL(id){
            let conf=confirm();
         if (conf) {
             this.deleteList(id).then(()=>{
               this.listings=this.listings.filter(listing=>listing.id!==id)               
               this.$snotify.success("List deleted")
             }) 
         }
        }
    },

    mounted() {
        this.getAllListings().then(res=>{
            this.listings=res.data.data
           
        })
    },
}
</script>

<style lang="scss" scoped>
</style>