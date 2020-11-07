<template>
    <div class="table-responsive">  
        <table class="table table-striped table-inverse table-responsive">
        <thead class="thead-inverse">
            <tr>
                <th>Id</th>
                <th>Firstname</th>
                <th>Email</th>
                <th>Location</th>
                <th>Activation</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="index">
                    <td scope="row">{{user.id}}</td>
                    <td>{{user.fullname}}</td>                                                                                                                                                                                   
                    <td>{{user.email}}</td>
                    <td>{{user.location}}</td>
                    <td>{{(user.id_verified_at && user.phone_verified_at && user.email_verified_at) ? 'Verified' : "Not Yet"}}</td>                                                                                                        
                    <td>
                        <button type="button" class="btn btn-danger" @click="deleteU(user.id)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete </button>
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
            users:[]
        }
    },

    methods: {
        ...mapActions(['getAllUsers','deleteUser']),

        deleteU(id){
            let conf=confirm();
         if (conf) {
             this.deleteUser(id).then(()=>{
               this.users=this.users.filter(user=>user.id!==id)               
               this.$snotify.success("User deleted")
             }) 
         }
        }
    },

    mounted() {
        this.getAllUsers().then(res=>{
            this.users=res.data.data
           
        })
    },
}
</script>

<style lang="scss" scoped>
</style>