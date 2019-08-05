<template>
    <table id="usersTable" class="table table-hover table-striped">
        <thead class="thead-dark">
        <tr>
            <th scope="col" width="7%">#</th>
            <th scope="col" width="28%">Nombre</th>
            <th scope="col" width="20%">Correo electrónico</th>
            <th scope="col" width="20%">Perfil</th>
            <th scope="col" width="20%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</template>

<script>
    import datatables from 'datatables'

    export default {
        created: function() {
            this.initTable();
        },

        data: function() {
            return{
                users: []
            }
        },

        methods: {
            initTable: function() {
                $(document).ready( function () {
                    $('#usersTable').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "getUsers",
                            "dataType":"json",
                            "type":"POST",
                            "data":{"_token": $('input[name="_token"]').val()}
                        },
                        "columns":[
                            {"data":"id"},
                            {"data":"name"},
                            {"data":"email"},
                            {"data":"level"},
                            {"data":"actions","searchable":false,"orderable":false}
                        ]
                    });
                } );
            },
        }
    }
</script>
