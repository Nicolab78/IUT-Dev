###########################################
# TP dev efficace semaine 1               #
# implementation file FIFO liste chaînée  #
###########################################



import unittest


class Cellule:
    def __init__(self, valeur, suivante):
        """création d'une cellule

        Args:
            valeur (quelconque): la valeur à stocker dans la cellule
            suivante (Cellule): la cellule suivante de la liste chaînée
        """
        self.valeur = valeur
        self.suivante = suivante

class File_LC:
    def __init__(self):
        """création file vide
        """

        self.entrée = None #dernier maillon de la liste, où on fait les ajouts
        self.sortie = None #premier maillon de la liste, prêt à sortir

    def est_vide(self):
        """renvoie un booléen indiquant si la file est vide
        """
        return self.sortie is None

    def ajouter(self, x):
        """ajoute x à la fin de la file

        Args:
            x : élément à ajouter
        """
        nouvelle_cellule = Cellule(x, None)
        if self.est_vide():
            self.sortie = nouvelle_cellule
            self.entrée = nouvelle_cellule
        else:
            self.entrée.suivante = nouvelle_cellule
            self.entrée = nouvelle_cellule

    def defiler(self):
        """renvoie et supprime l'élément le plus ancien de la file

        Raises:
            Exception: indique que la file est vide
        """
        if self.est_vide():
            raise Exception("La file est vide !")
        x = self.sortie.valeur
        self.sortie = self.sortie.suivante
        if self.sortie is None:
            self.entrée = None
        return x


""" 
A vous d'écrire les méthodes de la file ainsi que les tests !
"""

class TestFile(unittest.TestCase):

    def test_vide(self):
        f = File_LC()
        self.assertTrue(f.est_vide())

    def test_ajouter(self):
        f = File_LC()
        f.ajouter(10)
        self.assertFalse(f.est_vide())

    def test_ajouter_defiler_simple(self):
        f = File_LC()
        f.ajouter(42)
        self.assertEqual(f.defiler(), 42)
        self.assertTrue(f.est_vide())

    def test_ordre_fifo(self):
        f = File_LC()
        for i in range(5):
            f.ajouter(i)
        for i in range(5):
            self.assertEqual(f.defiler(), i)
        self.assertTrue(f.est_vide())

    def test_defiler_file_vide(self):
        f = File_LC()
        with self.assertRaises(BaseException):
            f.defiler()

    def test_scenario_complet(self):
        f = File_LC()
        self.assertTrue(f.est_vide())
        f.ajouter(1)
        f.ajouter(2)
        f.ajouter(3)
        self.assertEqual(f.defiler(), 1)
        f.ajouter(4)
        self.assertEqual(f.defiler(), 2)
        self.assertEqual(f.defiler(), 3)
        self.assertEqual(f.defiler(), 4)
        with self.assertRaises(BaseException):
            f.defiler()

    def test_reajouter_apres_vidage(self):
        # vérifie que sortie et entrée sont bien remis à None après un vidage complet
        f = File_LC()
        f.ajouter(1)
        f.defiler()
        self.assertTrue(f.est_vide())
        f.ajouter(2)
        self.assertEqual(f.defiler(), 2)


if __name__ == '__main__':
    unittest.main()