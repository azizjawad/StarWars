<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <strong> Star Wars Api Data</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <button class="btn btn-primary" v-on:click="pull_members()" type="submit" v-text="people_btn"></button>
                            &nbsp;&nbsp;&nbsp;<button class="btn btn-primary" v-on:click="pull_films()" type="submit" v-text="film_btn"></button>
                            &nbsp;&nbsp;&nbsp;<button v-if="data" class="btn btn-primary" v-on:click="save_data()" type="submit" v-text="save_btn"></button>
                        </div>
                        <members-table v-if="flag == 'people'" :members="data"></members-table>
                        <films-table v-if="flag == 'films'" :films="data"></films-table>
                        <div class="pagination pull-right" v-if="data">
                            <div class="btn-group">
                                <button @click="pull_data(data.previous)" :disabled="data.previous == null" type="button" class="btn btn-default btn-primary" >Previous</button>&nbsp;&nbsp;&nbsp;
                                <button @click="pull_data(data.next)" type="button" :disabled="data.next == null" class="btn btn-default btn-primary">Next</button>
                                <span v-show="show_loading" style="margin-top:5px;">&nbsp;&nbsp;&nbsp; Fetching data ...</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert';
    export default {
        name: "MainContainer",
        data(){
            return {
                data:false,
                people_btn:"Pull People",
                film_btn: "Pull Films",
                save_btn: "Save Data",
                show_loading:false,
                flag:0,
           }
        },
        methods:{
            pull_members(){
                this.people_btn = 'fetching peoples...';
                axios.get('https://swapi.co/api/people').then(res => {
                    this.flag = 'people';
                    this.data = res.data;
                    this.people_btn = 'Pull People';
                });
            },
            pull_data(page_url){
                this.show_loading = true;
                axios.get(page_url).then(res => {
                    this.show_loading = false;
                    this.flag = false;
                    this.$nextTick(() => {
                        this.flag = 'people';
                    });
                    this.data = res.data;
                });
            },
            pull_films(page_url = false){
                this.film_btn = 'fetching films...';
                axios.get('https://swapi.co/api/films').then(res => {
                    this.flag = 'films';
                    this.data = res.data;
                    this.film_btn = 'Pull Films';
                });
            },
            save_data(){
                this.save_btn = "Please wait ...";
                axios.post('home/save/'+this.flag,this.data.results).then(res => {
                    this.save_btn = "Save Data";
                    swal('Success !!',res.data.message,'success');
                });
            }
        }
    }
</script>

<style scoped>

</style>
