<template>
    <div class="table-responsive">
        <table v-if="data" class="table table-striped table-hover">
            <tr>
                <th>Title</th>
                <th>Opening Crawl</th>
                <th>Director</th>
                <th>Producer</th>
                <th>Release Date</th>
            </tr>
            <tr v-for="(films,index) in data.results" :key="index">
                <td v-text="films.title"></td>
                <td v-text="films.opening_crawl"></td>
                <td v-text="films.director"></td>
                <td v-text="films.producer"></td>
                <td v-text="films.release_date"></td>
            </tr>
        </table>
    </div>
</template>
<script>
    export default {
        name: "Films",
        props:['films'],
        data(){
            return{
                data:this.films,
                show_loading:false
            }
        },
        methods:{
            pull_data(page_url){
                this.show_loading = true;
                axios.get(page_url).then(res => {
                    this.show_loading = false;
                    this.data = res.data;
                });
            }
        }
    }
</script>

<style scoped>

</style>
