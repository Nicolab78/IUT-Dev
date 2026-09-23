runif(1)

runif(10)

runif(10, min = 0, max = 100)

piece <- runif(1)
if (piece < 0.5){
  print("Face")
} else {
  print("Pile")
}

de <- ceiling((runif(1, min = 0, max = 6)))
print(de)


lancers <- ceiling(runif(1000, min = 0, max = 6))
hist(lancers,
     main = "Simulation de 1000 lancers de dé",
     xlab = "Valeur du dé",
     breaks = 6,
     col = "lightgreen"
     )

