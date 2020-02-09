<template>
    <div class="table-responsive">
        <table v-if="data" class="table table-striped table-hover">
            <tr>
                <th>Name</th>
                <th>Birth Year</th>
                <th>Eye Color</th>
                <th>Gender</th>
                <th>Hair Color</th>
                <th>Skin Color</th>
            </tr>
            <tr v-for="(people,index) in data.results" :key="index">
                <td v-text="people.name"></td>
                <td v-text="people.birth_year"></td>
                <td v-text="people.eye_color"></td>
                <td v-text="people.gender"></td>
                <td v-text="people.hair_color"></td>
                <td v-text="people.skin_color"></td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        name: "Members",
        props:['members'],
        data(){
            return{
                data:this.members,
                show_loading:false
            }
        },
        methods:{
            pull_data(page_url){
                this.show_loading = true;
                axios.get(page_url).then(res => {
                    this.show_loading = false;
                    // this.data = res.data;
                    this.$emit('NewMembersData',this.data);
                });
            }
        }
    }
</script>

<style scoped>

</style>
