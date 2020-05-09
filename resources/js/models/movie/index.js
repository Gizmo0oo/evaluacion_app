import moment from 'moment'
class Movie {

    constructor({id = '', name = '', published_at = '', image = '', status = false}){
        this.id = id
        this.name = name
        this.image = image
        this.path = 'movies'
        this.status = status
        this.fullPath = `${this.path}/${this.id}`
        this.published_at = published_at
    }

    isComplete(){
        return !!this.name && !!this.published_at
    }

    static create(data = {}){
        return new Movie(data)
    }

}

export default Movie