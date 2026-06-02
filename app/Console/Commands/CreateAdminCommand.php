<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminCommand extends Command
{
    protected $signature = 'admin:create';

    protected $description = 'Cria um novo usuário administrador interativamente';

    public function handle(): int
    {
        $this->info('=== Criação de Administrador ===');
        $this->newLine();

        $name = $this->askName();
        $email = $this->askEmail();
        $password = $this->askPassword();

        User::create([
            'name'     => $name,
            'email'    => $email,
            'password' => Hash::make($password),
        ]);

        $this->newLine();
        $this->info("✓ Administrador criado com sucesso!");
        $this->line("  Nome:  {$name}");
        $this->line("  Email: {$email}");
        $this->newLine();
        $this->comment('Acesse o painel em /login com essas credenciais.');

        return self::SUCCESS;
    }

    private function askName(): string
    {
        do {
            $name = $this->ask('Nome completo');

            if (blank($name)) {
                $this->error('O nome não pode estar vazio.');
                continue;
            }

            return $name;
        } while (true);
    }

    private function askEmail(): string
    {
        do {
            $email = $this->ask('E-mail');

            $validator = Validator::make(
                ['email' => $email],
                ['email' => 'required|email']
            );

            if ($validator->fails()) {
                $this->error('E-mail inválido. Tente novamente.');
                continue;
            }

            if (User::where('email', $email)->exists()) {
                $this->error("O e-mail \"{$email}\" já está cadastrado.");
                continue;
            }

            return $email;
        } while (true);
    }

    private function askPassword(): string
    {
        do {
            $password = $this->secret('Senha (mínimo 8 caracteres, não aparece na tela)');

            if (strlen($password) < 8) {
                $this->error('A senha deve ter pelo menos 8 caracteres.');
                continue;
            }

            $confirm = $this->secret('Confirmar senha');

            if ($password !== $confirm) {
                $this->error('As senhas não coincidem. Tente novamente.');
                continue;
            }

            return $password;
        } while (true);
    }
}
