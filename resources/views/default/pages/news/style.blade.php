<style>
    .p_loader{
        position: relative;
    }

    .main{
        padding-top: 25px;
        font-size: 16px;
    }
    .form-control{
        font-size: 16px;
    }

    .nothing{
        font-size: 14px;
        color: red;
        display: none;
        position: absolute;
        bottom: 11%;
    }
 
    .loader {
        display: none;
        border: 2px solid #f3f3f3;
        border-radius: 50%;
        border-top: 2px solid #3498db;
        border-bottom: 2px solid #3498db;
        width: 16px;
        height: 16px;
        -webkit-animation: spin .5s linear infinite;
        animation: spin .5s linear infinite;
        position: absolute;
        top: 41px;
        right: 7%;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>