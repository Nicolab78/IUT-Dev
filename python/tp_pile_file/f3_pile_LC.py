##########################################
# TP dev efficace semaine 1              #
# implementation pile par liste chaînée  #
##########################################



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



class Pile:
    def __init__(self):
        """création d'une pile vide
        """
        self.sommet = None #le haut de la pile

    def est_vide(self):
        return self.sommet is None

    def empiler(self, x):
        self.sommet = Cellule(x, self.sommet)

    def depiler(self):
        if self.est_vide():
            raise Exception("La pile est vide !")
        x = self.sommet.valeur
        self.sommet = self.sommet.suivante
        return x



""" 
A vous d'écrire les méthodes de la pile ainsi que les tests !
"""


class TestPile(unittest.TestCase):

    def test_vide(self):
        p = Pile()
        self.assertTrue(p.est_vide())

    def test_empiler(self):
        p = Pile()
        p.empiler(10)
        self.assertFalse(p.est_vide())

    def test_empiler_depiler_simple(self):
        p = Pile()
        p.empiler(42)
        self.assertEqual(p.depiler(), 42)
        self.assertTrue(p.est_vide())

    def test_ordre_lifo(self):
        p = Pile()
        for i in range(5):
            p.empiler(i)
        for i in reversed(range(5)):
            self.assertEqual(p.depiler(), i)
        self.assertTrue(p.est_vide())

    def test_depiler_pile_vide(self):
        p = Pile()
        with self.assertRaises(BaseException):
            p.depiler()

    def test_scenario_complet(self):
        p = Pile()
        self.assertTrue(p.est_vide())
        p.empiler(1)
        p.empiler(2)
        p.empiler(3)
        self.assertEqual(p.depiler(), 3)
        p.empiler(4)
        self.assertEqual(p.depiler(), 4)
        self.assertEqual(p.depiler(), 2)
        self.assertEqual(p.depiler(), 1)
        with self.assertRaises(BaseException):
            p.depiler()


if __name__ == '__main__':
    unittest.main()