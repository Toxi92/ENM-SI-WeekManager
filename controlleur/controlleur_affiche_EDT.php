    <?php
    if(!isset($_SESSION)) {
        session_start();
    }
    include_once(__DIR__."/../modele/db.user.php");
    include_once(__DIR__."/../modele/db.auth.php");
    include_once(__DIR__."/../modele/db.task.php");


    $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'];

    $heures = ['08:00:00','09:00:00','10:00:00','11:00:00','12:00:00','13:00:00','14:00:00','15:00:00','16:00:00','17:00:00','18:00:00'];
    $edt = [];
    foreach ($jours as $jour) {
        foreach ($heures as $heure) {
            $edt[$jour][$heure] = '';
        }
    }

    if (isset($_SESSION['user'])) {
        $user = unserialize($_SESSION['user']);
        $queryTask = new QueryTask($bdd); // $bdd doit être ton objet Database
        $tasks = $queryTask->getTasksByEmail($user->getEmail());


        foreach ($tasks as $task) {
            $id = $task['id'];
            $jour = ucfirst(strtolower($task['Jour']));
            $debut = $task['DateHeureDeb'];
            $fin = $task['DateHeureFin'];
            $title = htmlspecialchars($task['Nom']);
            $desc = htmlspecialchars($task['Description']);
            $color = $task['Couleur'];

            $startIndex = array_search($debut, $heures);
            $endIndex = array_search($fin, $heures);

            // Si l'heure de fin n'est pas pile sur un créneau, on la prend comme exclusive
            if ($startIndex !== false && $endIndex !== false) {
                for ($i = $startIndex; $i < $endIndex; $i++) {
                    $edt[$jour][$heures[$i]] = "<a href='/../vue/detailsTask.php?id=$id' style='color:inherit;text-decoration:none;'><div class='TaskCell' style='background: $color;'>$title<br><span class='TaskDesc'>$desc</span></div></a>";
                }
            }
        }
    }
    ?>

    <div class="DivEmploiDuTemps">
        <table class="EmploiDuTemps">
            <thead>
                <tr>
                    <th>Heures</th>
                    <?php foreach ($jours as $jour): ?>
                        <th><?php echo $jour; ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < count($heures) - 1; $i++): ?>
                    <tr>
                        <td><?php echo substr($heures[$i],0,5) . ' - ' . substr($heures[$i+1],0,5); ?></td>
                        <?php foreach ($jours as $jour): ?>
                            <td>
                                <?php echo $edt[$jour][$heures[$i]]; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>