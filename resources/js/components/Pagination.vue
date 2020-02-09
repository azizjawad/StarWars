<template>
    <div class="pagination pull-right" v-if="members">
        <div class="btn-group">
            <button v-on:click="pull_data(members.previous)" :disabled="members.previous == null" type="button" class="btn btn-default btn-primary" >Previous</button>&nbsp;&nbsp;&nbsp;
            <button v-on:click="pull_data(members.next)" type="button" :disabled="members.next == null" class="btn btn-default btn-primary">Next</button>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Pagination"
    }
</script>

<style scoped>

</style>
