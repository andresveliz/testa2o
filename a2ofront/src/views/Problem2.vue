<template>
    <div class="container">
        <h3>Problem 2</h3>
        <hr>
        <div class="row">
            <div class="col-sm-5">
                <h4>  Input:</h4>
                <p>Enter the values in the textarea:</p> 
                <div class="mb-3">
                    <textarea   class="form-control" 
                                id="input-2" rows="6" 
                                v-model.trim="input2"
                     ></textarea>
                    <span class="text-danger" v-if="constraint==true">Error, there is an obstacle in the same place as the queen</span>
                    <button class="form-control  btn btn-primary" @click.prevent="play()">Play</button>
                    
                </div>
            </div>
            <div class="col-sm-7">
                <h4>Output:</h4>
                    <pre id="output-2"> <strong>Result:</strong> {{result}}</pre>   
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    name: 'problem-2',
    data() {
        return {
            input2: '',
            n: '',
            k: '',
            rq: '',
            cq: '',
            obstacles: [],
            
            array: [],
            result: '',
            constraint: false
        }
    },
    methods: {
        play() {
            let me = this;
            this.constraint = false;
            me.validate();
            if(me.constraint == true)
            {
                me.result = [];
            }
            else{
                
                this.arrayForm();
                axios.post('http://127.0.0.1:8000/api/queensAttack',{
                    'n': me.array[0][0],
                    'k': me.array[0][2],
                    'rq': me.array[1][0],
                    'cq': me.array[1][2],
                    'obstacles': me.obstacles
                })
                .then(function(response){
                    me.result = response.data;

                })
                .catch(function(error){
                    console.log(error)
                })
            }
        },
        validate(){
            this.array =  this.input2.split(/\n/);

            for(let i=2; i< (this.array.length) ; i++)
            {                
                if(this.array[i] == this.array[1])
                {
                    this.constraint = true;
                }
            }
                    
        },
        arrayForm(){
            for(let i=8; i<this.input2.length; i=i+4 )
            {
                this.obstacles.push([ Number(this.input2[i]), Number(this.input2[i+2])])
            }
        },
        
        
    }
}
</script>