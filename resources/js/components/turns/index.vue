<template>
    <section class="border border-black mb-2">
        <List :columns="columns" v-if="turns_isEmpty" action='turns/ORDER_BY'>
            <tr v-for="(turn,index) in turns.data" :key="index">
                <td>{{turn.id}}</td>
                <td>{{turn.time}}</td>
                <td>{{turn.status | isActive}}</td>
                <td><Actions :item="turn" :movie="movie" :action="'turns/DELETE_TURN'" :isAssing="false"/></td>
            </tr>
        </List>
        <Empty :message="'No hay turnos'" v-else/>
    </section>
</template>

<script>
    import List from '../AppList'
    import Empty from '../Empty'
    import Actions from '../Actions'
    import Turn from '../../models/turn/index'
    import Collection from '../../models/Collection'
    export default {
        name: 'turns',
        data:()=> ({columns:['id','turno','estado',''], movie:{}}),
        components:{List,Empty,Actions},
        computed:{
            turns(){
                return this.$store.getters['turns/turns']
            },
            turns_isEmpty(){
                return this.$store.getters['turns/isEmpty']
            }
        },
        methods:{
            getMovie(){
                const {movie = null} = this.$route.query
                this.movie = movie ? this.$store.getters['movies/findById'](movie) : {}
            },
            async getTurns(){
                const URL = '/v1/turns'
                try {
                    const {data:{turns}} = await axios.get(URL)
                    const data = this.movie.id ? turns.map(turn => {
                        turn.isSelected = this.movie.turns.map(({id}) => id).includes(turn.id)
                        return turn
                    }) : turns
                    this.$store.dispatch('turns/SET_TURNS', {turns:Collection.create(data, Turn)})
                } catch (error) {
                    console.log(error)
                }
            }
        },
        created(){
            this.getTurns()
            this.getMovie()
        }
    }
</script>