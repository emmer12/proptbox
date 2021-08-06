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
            </tr>
            </thead>
            <tbody>
                <tr v-for="(boosted, index) in boosteds" :key="index">
                    <td scope="row">{{boosted.id}}</td>
                    <td>{{boosted.user.id}}</td>              
                    <td>{{boosted.space_type}}</td>                                                                                                                                                                                   
                    <td>{{boosted.space_location}}</td>                                                                                                                                                                                   
                    <td>{{boosted.space_address}}</td>                                                                                                                                                                                   
                    <td>{{boosted.boosted ? "Boosted" : "Not boosted"}}</td>                                                                                                                                                                                   
                  
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
            boosteds:[]
        }
    },

    methods: {
        ...mapActions(['getAllBoosted'])
    },

    mounted() {
        this.getAllBoosted().then(res=>{
            this.boosteds=res.data.data
           
        })
    },
}
</script>

<style lang="scss" scoped>
</style>