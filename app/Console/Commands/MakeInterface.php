<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MakeInterface extends Command
{
    /** @var String DIRETORIO_REPOSITORY */
    const DIRETORIO_REPOSITORY = "./app/Repositories";

    /** @var String DIRETORIO_INTERFACE */
    const DIRETORIO_INTERFACE = "./app/Repositories/Contracts";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:interface {nameInterface?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Comando para criar interface.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $interface_name = $this->argument('nameInterface');

            if (empty($interface_name)) throw new \Exception("Necessário informar o nome da interface.", 1);

            if (!is_dir(self::DIRETORIO_REPOSITORY)) mkdir(self::DIRETORIO_REPOSITORY, 0777);

            if (!is_dir(self::DIRETORIO_INTERFACE)) mkdir(self::DIRETORIO_INTERFACE, 0777);

            $interface_path = self::DIRETORIO_INTERFACE . "/" . trim($interface_name) . ".php";

            if (is_file($interface_path)) throw new \Exception("Interface já existe no projeto.", 1);

            touch($interface_path);

            $interface_file = fopen($interface_path, "r+");

            fwrite($interface_file, self::estrutura_interface($interface_name));

            fclose($interface_file);

            $this->info("Interface created successfully.");
        } catch (\Exception $e) {
            $this->error("ERRO: {$e->getMessage()}");
        }
    }

    /**
     * Retorna estrutura básica de uma Interface.
     *
     * @param String $interface_name
     *
     * @return String
     */
    private static function estrutura_interface(string $interface_name) : string
    {
        $conteudo = "<?php" . PHP_EOL . PHP_EOL;
        $conteudo .= "namespace App\Repositories\Contracts;" . PHP_EOL . PHP_EOL;
        $conteudo .= "interface {$interface_name}" . PHP_EOL;
        $conteudo .= "{" . PHP_EOL;
        $conteudo .= "\t//" . PHP_EOL;
        $conteudo .= "}" . PHP_EOL;

        return $conteudo;
    }
}
