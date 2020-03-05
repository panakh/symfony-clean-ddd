# symfony-clean-ddd
A symfony application with DDD, bounded context,  and clean architecture

# todo context
User micro service and bounded context

This has a symfony 5 application. To run `symfony serve -d` and then `symfony open:local`


    cd todo
    symfony console doctrine:database:create
    symfony console doctrine:migrations:migrate
    symfony serve -d
    symfony open:local
    
