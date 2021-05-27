<template>
    <div class="container">
        <h3>Problem 3</h3>
        <hr>
        <div class="row">
            <div class="col-sm-5">
                <h4>  Input:</h4>
                <p>Enter the string in the textarea:</p> 
                <div class="mb-3">
                    <textarea   class="form-control" 
                                id="input-3" rows="4" 
                                v-model.trim="input3" 
                                style="text-transform:lowercase;"
                                onkeyup="javascript:this.value=this.value.toLowerCase();" ></textarea>
                    <span class="text-danger" v-if="constraint==true">Error, there is an obstacle in the same place as the queen</span>
                    <button class="form-control  btn btn-primary" @click.prevent="calculate()">Calculate</button>
            
                </div>
            </div>
            <div class="col-sm-7">
                <h4>Output:</h4>
                    {{max}}
                    <pre id="output-3"> <strong>Result:</strong> {{result}}</pre>   
           
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios'
export default {
    name: 'problem-3',
    data() {
        return{
            input3: '',
            result: '',
            constraint: false,
            max: ''
        }

    },
    methods: {
        
        calculate(){
            let me = this;

            axios.post('http://127.0.0.1:8000/api/stringValue',{
                't': me.input3
            })
            .then(function(response){
                me.result = response.data
                me.max = Math.max(...me.result);
            })
            .catch(function(error){
                console.log(error);
            })
        },
        lower(){
            this.input3.toLowerCase();
        }
    }
}
</script>