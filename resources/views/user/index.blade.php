@extends('app')

@section('content')

<users-table></users-table>

@endsection

@section('scripts')
<script>
import Vue from 'vue'
import UsersTable from './components/UsersTable.vue'

const app = new Vue({
    el: '#app',
    components: {
        UsersTable
    }
});
</script>
@endsection
