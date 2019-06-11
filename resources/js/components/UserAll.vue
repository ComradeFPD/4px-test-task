<template>
    <div class="container">
        <div class="col-lg-12">
        <table class="table table-responsive-lg"></table>
            <tr>
                <th>Имя</th>
                <th>Email</th>
                <th>Действия</th>
            </tr>
            <div v-for="user in users">
                <tr>
                    <td>{{ user.name }}</td>
                    <td>{{ user.email }}</td>
                    <td>
                        <a v-bind:href="'/departments/update/' + user.id" class="btn btn-success">Изменить</a>
                        <a v-bind:href="'/departments/delete/' + user.id" class="btn btn-warning">Изменить</a>
                    </td>
                </tr>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserAll",
        props: ['users']
    }
</script>

<style scoped>

</style>