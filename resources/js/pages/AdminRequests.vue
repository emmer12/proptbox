<template>
    <div class="table-responsive">  
        <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>Owner Id</th>
                <th>Space Type</th>
                <th>Space location</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(request, index) in requests" :key="index">
                    <td scope="row">{{request.id}}</td>
                    <td>{{request.user_id}}</td>                                                                                                                                                                                   
                    <td>{{request.space_type}}</td>                                                                                                                                                                                   
                    <td>{{request.space_location}}</td>                                                                                                                                                                                   
                    <td>
                        <button type="button" class="btn btn-danger" @click="deleteR(request.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </button>
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
            requests:[]
        }
    },

    methods: {
        ...mapActions(['getAllRequests','deleteRequest']),

           deleteR(id){
            let conf=confirm();
         if (conf) {
             this.deleteRequest(id).then(()=>{
               this.requests=this.requests.filter(request=>request.id!==id);               
               this.$snotify.success("Request deleted")
             }) 
         }
        }
    },

    mounted() {
        this.getAllRequests().then(res=>{
            this.requests=res.data.data
           
        })
    },
}
</script>

<style lang="scss" scoped>
</style>