<template>
    <div class="flex" style="justifyContent: space-around;">
        <div class="rounded overflow-hidden shadow-lg p-4" style="width:600px;">
            <img :src="'https://image.tmdb.org/t/p/w342' + movieData.poster_path" alt="movie_poster" style="height:400px;margin: auto;">
            <div class="px-6 py-4 overflow-hidden">
                <div class="font-bold text-xl mb-2 text-center">{{ movieData.title }}</div>
                <p class="text-gray-700 text-base">
                {{ movieData.overview }}
                </p>
            </div>
            <div class="px-6 pt-4 pb-2 text-center">
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ movieData.release_date }}</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ movieData.vote_count }}</span>
                <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ movieData.vote_average }}/10</span>
            </div>
        </div>
        <div class="p-4">
            <table class="table-auto">
            <tbody>
                <tr v-for="i in this.seats.nr_rows" :key="i">
                    <td v-for="j in this.seats.columns" :key="j">
                        <Seat :row="i" :col="j.column" @click="startReservation(i, j.column)" :isReserved="checkIfSeatIsTaken(i, j.column)"/>  
                    </td>
                </tr>
            </tbody>
        </table> 
        <button v-if="currentSeats.length > 0" class="btn btn-primary" @click.prevent="submitReservation">Reserve Seat</button>
        <p v-if="errorMsg">Something went wrong!</p>
        <p v-if="responseMessage">{{ this.responseMessage }}</p>
        </div>
    </div>
</template>

<script>
    import Seat from "./Seat.vue"

    export default{
        name: 'Reservation',
        components: {Seat},

        mounted() {
           // this.getReservedSeats()
            this.getMovieData()
            this.getSeats()
            //console.log(movieData);
        },
        data() {
            return {
                reservedSeats: [],
                movieId: this.getMovieId(),
                errorMsg: null,
                responseMessage: null,
                currentSeats: [],
                loading: false,
                seats: [],
                movieData: {}
            };
        },
        methods: {
            getMovieData() {
                axios.get("/api/movieData/" + this.movieId)
                .then(response => {
                    this.movieData = response.data
                    
                })
            },
            getMovieId () {
                return window.location.href.split("/").slice(-1)[0];
            },
            getSeats() {
              
              this.seats = []
              axios.get("/api/seats")
              .then(response => {
                  this.seats = response.data.data
              })
          },
            getReservedSeats() {
                axios.get("/api/reservedSeats")
                .then(response => {
                    this.reservedSeats = response.data.reservedSeats
                })

            },
          
            startReservation(i, j) {
                
                var obj = {
                    'row': i,
                    'col': j
                }

                const idx = this.currentSeats.findIndex(seat => seat.row == i && seat.col == j)
                if(idx == -1) {
                    this.currentSeats.push(obj)
                } else {
                    this.currentSeats.splice(idx)
                }
            },
            submitReservation() {
                axios.post("api/reserve", {seats: this.currentSeats, movieId: this.movieId})
                .then(response => {
                    this.responseMessage = response.data.message
                }).catch(error => {
                    this.errorMsg = 'something went wrong'
                })
            },
            checkIfSeatIsTaken(i, j) {

                const idx = this.reservedSeats.findIndex(seat => seat.row == i && seat.column == j)
                return (idx == -1) ? false : true
            }
        }
    }

</script>